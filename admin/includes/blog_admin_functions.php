<?php
/******************************************************************************
 ** Blog Post Manager | Variables & Functions *********************************
 ******************************************************************************/

$post_id = 0;
$post_author_id = 1;
$post_parent_id = null;
$post_name = "";
$post_meta_name = "";
$post_slug = "";
$post_image = 0;
$post_published = 0;
$post_created_at = 0;
$post_updated_at = 0;
$post_published_at = 0;
$post_body = "";

$isEditingPost = false;

function getAllPosts()
{
    global $conn;

    $query = "SELECT * FROM `post` ORDER BY `id` DESC";
    $result = $conn->query($query);

    if ($result->num_rows > 0)
    {
        $final_result = $result->fetch_all(MYSQLI_ASSOC);
        // print_r($final_result);
        return $final_result;
    }
    echo "Fail";
    return -1;
}
function getPostById($request_id)
{
    global $conn, $post_id;

    $stmt = $conn->prepare("SELECT * FROM `post` WHERE `id`=? LIMIT 1");
    $stmt->bind_param("i", $post_id);

    $post_id = $request_id;
    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if(!$result) exit("No rows");

    return $result[0];
}

// If user clicks the "Create Post" button...
if (isset($_POST['create_post'])) { createPost($_POST); }

// If user clicks the "Edit Tag" button...
if (isset($_GET['edit-post'])) {
    $isEditingPost = true;
    $post_id = $_GET['edit-post'];
    editPost($post_id);
}
// If user clicks the "Update Topic" button...
if (isset($_POST['update_post']))
{
    updatePost($_POST);
}
// If user clicks the "Delete Topic" button...
if (isset($_POST['delete_post']))
{
    deletePost($_POST['post_id']);
}

function createPost($request_values)
{
    global $conn, $errors, $post_image, $post_name, $post_summary, $post_body, $post_published;
    $post_image = $request_values['post_image'];
    $post_name = esc($request_values['post_name']);
    $post_summary = $request_values['post_summary'];
    $post_body = $request_values['post_body'];
    $post_published = $request_values['post_published'];
    // Create slug: if name is "Dope Blogs", return "dope-blogs" as slug.
    // Used for post identification and to prevent duplicate post names.
    $post_slug = makeSlug($post_name);
    // Validate form
    if(empty($post_name))
    {
        array_push($errors, "Post name required");
    }
    if(empty($post_summary))
    {
        array_push($errors, "Post summary required");
    }
    if(empty($post_body))
    {
        array_push($errors, "Post body required");
    }
    if(empty($post_published))
    {
        array_push($errors, "Indicate whether post will be published or not");
    }
    // Ensure that this post has a new name.
    $stmt = $conn->prepare("SELECT `name` FROM `post` WHERE `slug`=? LIMIT 1");
    $stmt->bind_param("s", $post_slug);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    if($result)
    {
        $post_name = $post_name . " 1";
    }
    
    // Register post if there are no errors in the form
    if(count($errors) == 0)
    {
        if($request_values['post_published'] == 1)
        {
            $post_published = 1;
        }else
        {
            $post_published = 0;
        }
        $stmt = $conn->prepare("INSERT INTO `post` (image, name, slug, published, summary, body) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $post_name, $post_slug, $post_published, $post_summary, $post_body);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Post created successfully";
        header('location: blog_admin.php');
        exit(0);
    }

}

function editPost($request_id)
{
    global $conn, $isEditingPost, $post_id, $post_published, $post_image, $post_name, $post_summary, $post_body;

    $result = getPostById($request_id);
    $post_id = $result['id'];
    $post_published = $result['published'];
    $post_image = $result['image'];
    $post_name = $result['name'];
    $post_summary = $result['summary'];
    $post_body = $result['body'];

    $isEditingPost = true;
}

function updatePost($request_values)
{
    global $conn, $errors, $post_id, $post_image, $post_name, $post_summary, $post_body;
    $post_id = $request_values['post_id'];
    $post_image = $request_values['post_image'];
    $post_name = esc($request_values['post_name']);
    $post_summary = $request_values['post_summary'];
    $post_body = $request_values['post_body'];
    // Create slug: if name is "Dope Blogs", return "dope-blogs" as slug.
    // Used for post identification and to prevent duplicate post names.
    $post_slug = makeSlug($post_name);
    // Validate form
    if(empty($post_name))
    {
        array_push($errors, "Post name required");
    }
    if(empty($post_summary))
    {
        array_push($errors, "Post summary required");
    }
    if(empty($post_body))
    {
        array_push($errors, "Post body required");
    }
    // Ensure that this post has a new name.
    $stmt = $conn->prepare("SELECT `id`, `name` FROM `post` WHERE `slug`=? LIMIT 1");
    $stmt->bind_param("s", $post_slug);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    if($result)
    {
        if($result[0]['id'] != $post_id)
        {
            $post_name = $post_name . " 1";
        }
    }
    
    // Register post if there are no errors in the form
    if(count($errors) == 0)
    {
        if($request_values['post_published'] == 1)
        {
            $post_published = 1;
        }else
        {
            $post_published = 0;
        }
        $stmt = $conn->prepare("UPDATE `post` SET `name`=?, `slug`=?, `image`=?, `published`=?, `summary`=?, `body`=? WHERE `id`=?");
        $stmt->bind_param("sssissi", $post_name, $post_slug, $post_image, $post_published, $post_summary, $post_body, $post_id);
        $stmt->execute();
        $stmt->close();

        //$_SESSION['message'] = "Post updated successfully";
        //header('location: blog_admin.php#post_manager');
        //exit(0);
    }
}
function deletePost($tag_id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM `post` WHERE `id`=?");
    $stmt->bind_param("i", $tag_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Post successfully deleted";
    header("location: blog_admin.php");
    exit(0);
}


function getPostImg($image_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM `media` WHERE `id`=? LIMIT 1");
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return "<img src='../" . $result[0]['base_path'] . "' alt='" . $result[0]['alt'] . "'>";
}
function getPostAuthor($author_id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id`=? LIMIT 1");
    $stmt->bind_param("i", $author_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $result[0]['first_name'] . ' ' . $result[0]['last_name'];
}
?>