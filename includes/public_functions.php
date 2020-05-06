<?php

/**
 * Catch-all: Returns rows from a custom query.
 */
function returnRows($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_rows = array();
    foreach($rows as $row)
    {
        array_push($final_rows, $row);
    }
    return $final_rows;
}

function getPublishedPosts()
{
    $query = "SELECT * FROM blog_post WHERE published=true ORDER BY created_at DESC";
    return returnRows($query);
}


/**
 * Return an array of all the `course` rows.
 */
function getAllCourses()
{
    return returnRows("SELECT * FROM `course` ORDER BY `name`");
}
function getCoursePreviewImage($course_id)
{
    $query = "SELECT
        media.base_path AS 'base',
        media.alt AS 'alt' FROM `projects`
        INNER JOIN media ON (projects.image=media.id)
        INNER JOIN project_academic_scope ON (projects.id=project_id)
        WHERE course_id=$course_id 
        ORDER BY projects.id DESC LIMIT 1";
    
    $result = returnRows($query);

    if(sizeof($result) == 1)
    {
        return $result[0];
    }
    return false;
}
function getCourse($course_slug)
{
    $query = "SELECT * FROM `course` WHERE `slug`='$course_slug' LIMIT 1";

    return returnRows($query)[0];
}

function getCourseProjects($course_id)
{
    $query = "SELECT
        course_id, project_id, ordered_value,
        `course`.name AS course_name,
        `projects`.slug AS slug,
        `projects`.name AS project_name,
        `projects`.summary AS project_summary,
        `projects`.image AS image,
        `projects`.created_at AS created_at
        FROM `course_projects`
        INNER JOIN `course`
            ON course_id=`course`.id
        INNER JOIN `projects`
            ON project_id=`projects`.id
        WHERE course_id=$course_id
        ORDER BY `created_at` DESC";

    return returnRows($query);
}




function getNumPublishedPosts($limit)
{
    global $conn;
    $sql = "SELECT * FROM blog_post WHERE published=true ORDER BY created_at DESC LIMIT $limit";
    $result = mysqli_query($conn, $sql);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();

    foreach($posts as $post)
    {
        $post['category'] = getPostCategory($post['id']);
        array_push($final_posts, $post);
    }

    return $final_posts;
}
function getPublishedProjects($scope_id)
{
    global $conn;
    $sql = "SELECT * FROM blog_post INNER JOIN project ON (project.blog_id=blog_post.id) WHERE published=true AND portfolio_scope_id=$scope_id ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();

    foreach($posts as $post)
    {
        array_push($final_posts, $post);
    }

    return $final_posts;
}


function getPostCategory($post_id)
{
    global $conn;
    $sql = "SELECT * FROM category WHERE id=(SELECT category_id FROM blog_post_category WHERE post_id=$post_id) LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

    return $category;
}

function getPost($slug)
{
    global $conn;

    $post_slug = $_GET['post-slug'];
    $sql = "SELECT * FROM blog_post WHERE slug='$post_slug' AND published=true";
    $result = mysqli_query($conn, $sql);

    $post = mysqli_fetch_assoc($result);
    if($post)
    {
        $post['category'] = getPostCategory($post['id']);
    }
    return $post;
}

function getPostAuthor($author_id)
{
    global $conn;

    $sql = "SELECT * FROM users WHERE id=$author_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    $author = mysqli_fetch_assoc($result);
    return $author['first_name'] . ' ' . $author['last_name'];
}
function getPostImg($image_id)
{
    global $conn;

    $sql = "SELECT * FROM media WHERE id=$image_id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    $image = mysqli_fetch_assoc($result);
    return "<img src='" . $image['base_path'] . "' alt='" . $image['alt'] . "'>";
}
function getPostSummary($post)
{    
    if(!isset($post['summary']))
    {
        return "<p>This blog post has no summary yet.</p>";
    }else
    {
        return "<p class=\"summary\">".$post['summary']."</p>";
    }
}
function setBanner()
{

}

?>