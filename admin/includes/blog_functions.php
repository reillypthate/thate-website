<?php

function getAllPosts()
{
    global $conn;

    $sql = "SELECT * FROM blog_post ORDER BY created_at DESC";

    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach($posts as $post)
    {
        array_push($final_posts, $post);
    }
    return $final_posts;
}


/******************************************************************************
 ** Blog Manager | Variables & Functions **************************************
 ******************************************************************************/

$isEditingPost = false;
$postId = 0;
$post_name = "";
$post_summary = "";
$post_body = "";
$post_published = 0;
$post_banner = "";

if(isset($_POST['create_post']))
{
    createPost($_POST);
}

if(isset($_GET['edit-post']))
{
    $isEditingPost = true;
    $postId = $_GET['edit-post'];
    
    editPost($postId);
}
if(isset($_POST['update_post']))
{
    $isEditingPost = false;
    $post_name = "";
    $post_summary = "";
    $post_body = "";

    updatePost($_POST);
}
if(isset($_GET['delete-post']))
{
    deletePost($_GET['delete-post']);
}

function createPost($request_values)
{
    global $conn, $errors, $post_name, $post_summary, $post_body, $post_banner, $post_published;

    $post_name = esc($request_values['post_name']);
    $post_summary = esc($request_values['post_summary']);
    $post_body = esc($request_values['post_body']);
    $post_banner = esc($request_values['post_banner']);
    $post_published = esc($request_values['post_published']);

    // Validate form
    if(empty($post_name))
    {
        array_push($errors, "Post title required");
    }
    if(empty($post_summary))
    {
        array_push($errors, "Post summary required");
    }
    if(empty($post_body))
    {
        array_push($errors, "Post body required");
    }
    if(empty($post_banner))
    {
        array_push($errors, "Post banner required");
    }
    
    $post_slug = makeSlug($post_name);

    if(count($errors) == 0)
    {
        $query = "INSERT INTO blog_post (author_id, name, slug, summary, body, published, created_at, image) VALUES(1, '$post_name', '$slug', '$post_summary', '$post_body', $post_published, now(), $post_banner)";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Blog added successfully!";
        header('location: blog_manager.php');
        exit(0);
    }
}

function editPost($post_id)
{
    global $conn, $post_name, $post_summary, $post_body, $isEditingPost, $postId, $post_published, $post_banner;

    $query = "SELECT * FROM blog_post WHERE id=$post_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);

    $post_name = $post['name'];
    $post_summary = $post['summary'];
    $post_body = $post['body'];
    $post_published = $post['published'];
    $post_banner = $post['image'];

    echo $post_banner;
}

function updatePost($request_values)
{
    global $conn, $errors, $postId, $post_name, $post_summary, $post_body, $post_banner, $post_published;

    $post_name = esc($request_values['post_name']);
    $post_summary = esc($request_values['post_summary']);
    $post_body = esc($request_values['post_body']);
    $post_banner = esc($request_values['post_banner']);
    $post_published = esc($request_values['post_published']);
    
    // Validate form
    if(empty($post_name))
    {
        array_push($errors, "Post title required");
    }
    if(empty($post_summary))
    {
        array_push($errors, "Post summary required");
    }
    if(empty($post_body))
    {
        array_push($errors, "Post body required");
    }
    if(empty($post_banner))
    {
        array_push($errors, "Post banner required");
    }
    $post_slug = makeSlug($post_name);

    if(count($errors) == 0)
    {
        $query = "UPDATE blog_post SET name='$post_name', slug='$post_slug', summary='$post_summary', body='$post_body', image=$post_banner, published=$post_published WHERE id=" . $request_values['post_id'] . "";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Blog updated successfully!";
        header('location: blog_manager.php');
        exit(0);
    }
}

function deletePost($post_id)
{
    global $conn;

    $query = "DELETE FROM blog_post WHERE id=$post_id";

    if(mysqli_query($conn, $query))
    {
        $_SESSION['message'] = "Post successfully deleted";
        header("location: blog_manager.php");
        exit(0);
    }
}
?>