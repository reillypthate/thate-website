<?php

// Blog Post Variables
$post_id = 0;
$post_title = "";
$isEditingPost = false;
$published = 0;
$post_title = "";
$post_slug = "";
$content = "";
$featured_image = "";
$post_category = "";

function getAllPosts()
{
    global $conn;

    $sql = "SELECT * FROM blog_post";

    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach($posts as $post)
    {
        array_push($final_posts, $post);
    }
    return $final_posts;
}

if (isset($_POST['create_post']))
{
    createPost($_POST);
}

if (isset($_GET['edit-post']))
{
    $isEditingPost = true;
    $post_id = $_GET['edit-post'];
    editPost($post_id);
}

if (isset($_GET['delete-post']))
{
    $post_id = $_GET['delete-post'];
    deletePost($post_id);
}

function createPost($request_values)
{
    global $conn, $errors, $post_title, $featured_image, $category_id, $content, $published;

    $post_title = esc($request_values['title']);
    /*$content = htmlentities(esc($request_values['content']));
    if (isset($request_values['category_id']))
    {
        $category_id = esc($request_vlaues['category_id']);
    }
    if (isset($request_values['publish']))
    {
        $published = esc($request_values['publish']);
    }
*/
    $post_slug = makeSlug($post_title);

    if(empty($post_title))
    {
        array_push($errors, "Post title is required");
    }/*
    if(empty($content))
    {
        array_push($errors, "Post content is required");
    }
    if(empty($category_id))
    {
        array_push($errors, "Post category is required");
    }

    $featured_image = $_FILES['featured_image']['name'];
    if(empty($featured_image))
    {
        array_push($errors, "Featured image is required");
    }
    $target = "../static/images/" .basename($featured_image);
    if(!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target))
    {
        array_push($errors, "Failed to upload image. Please check file settings for your server");
    }
*/
    $post_check_query = "SELECT * FROM blog_post WHERE slug='$post_slug' LIMIT 1";
    $result = mysqli_query($conn, $post_check_query);

    if(mysqli_num_rows($result) > 0)
    {
        array_push($errors, "A post already exists with that title");
    }

    if(count($errors) == 0)
    {
        $query = "INSERT INTO blog_post (author_id, title, slug, published, created_at) VALUES(1, '$post_title', '$post_slug', $published, now())";
        //$query = "INSERT INTO blog_post(author_id, title, slug, image, content, published, created_at, updated_at) VALUES(1, '$post_title', '$post_slug', '$featured_image', '$content', $published, now(), now())";
        mysqli_query($conn, $query);
        //if(mysqli_query($conn, $query))
        //{
            /*
            $inserted_post_id = mysqli_insert_id($conn);

            $sql = "INSERT INTO blog_post_category (category_id, post_id) VALUES($category_id, $inserted_post_id)";
            mysqli_query($conn, $sql);
            */
            $_SESSION['message'] = "Post created successfully";
            header('location: post_manager.php');
            exit(0);
        //}else
       //{
        //    array_push($errors, "Post not created.");
        //}
    }
}

function editPost()
{
    global $conn, $post_title, $post_slug, $content, $published, $isEditingPost, $post_id;
    $sql = "SELECT * FROM blog_post WHERE id=1 LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    $post_title = $post['title'];
    $content = $post['content'];
    $published = $post['published'];
}
function updatePost($request_values)
{
    global $conn, $errors, $post_id, $post_title, $featured_image, $topic_id, $content, $published;

    $post_title = esc($request_values['title']);
    $content = esc($request_values['content']);
    $post_id = esc($request_values['post_id']);

    if (isset($request_values['category_id']))
    {
        $category_id = esc($request_calues['category_id']);
    }
    $post_slug = makeSlug($post_title);
    
    if(empty($post_title))
    {
        array_push($errors, "Post title is required");
    }
    if(empty($content))
    {
        array_push($errors, "Post body is required");
    }
    if(isset($_POST['featured_image']))
    {
        $featured_image = $_FILES['featured_image']['name'];

        $target = "../static/imiages/" . basename($featured_image);
        if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target))
        {
            array_push($errors, "Failed to upload image. Please check file settings for your server");
        }
    }

    if(count($errors) == 0)
    {
        $query = "UPDATE blog_post SET title='$post_title', slug='$post_slug', image='$featured_image', content='$content', published=$published, updated_at=now() WHERE id=$post_id";

        if(mysqli_query($conn, $query))
        {
            if(isset($category_id))
            {
                $inserted_post_id = mysqli_insert_id($conn);

                $sql = "INSERT INTO blog_post_category (category_id, post_id) VALUES($category_id, $inserted_post_id)";
                mysqli_query($conn, $sql);
                $_SESSION['message'] = "Post created successfully";
                header('location: post_manager.php');
                exit(0);
            }
            $_SESSION['message'] = "Post updated successfully";
            header('location: post_manager.php');
            exit(0);
        }
    }
}
function deletePost($post_id)
{
    global $conn;
    $sql = "DELETE FROM blog_post WHERE id=$post_id";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['message'] = "Post successfully deleted";
        header("location: post_manager.php");
        exit(0);
    }
}

?>