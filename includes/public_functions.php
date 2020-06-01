<?php


/******************************************************************************/
/** Course Functions **********************************************************/
/******************************************************************************/

/**
 * Return an array of all the `course` rows.
 */
function getAllCourses()
{
    return returnRows("SELECT * FROM `course` ORDER BY `name`");
}
function getCourse($course_slug)
{
    $query = "SELECT * FROM `course` WHERE `slug`='$course_slug' LIMIT 1";

    return returnRows($query)[0];
}
function getCoursesBySlugs($course_slugs)
{
    $query = "SELECT * FROM `course` WHERE ";

    for($i = 0; $i < count($course_slugs); $i++)
    {
        $query = $query . "`slug`='$course_slugs[$i]'";
        if($i < count($course_slugs)-1)
        {
            $query = $query ." OR ";
        }
    }

    return returnRows($query);
}
/**
 * This function returns the courses that have projects associated with them.
 * This will be used when I want to list the courses I've taken without directing the user to a course without work.
 */
function getCoursesWithProjects()
{
    // This query returns the course_id's with at least 1 project.
    $query = "SELECT 
        DISTINCT `course_id`, 
        `course`.name, 
        `course`.slug, 
        `course`.summary FROM `course_projects`
        INNER JOIN `course`
            ON `course_id`=`course`.id
        ORDER BY name";

    $result = returnRows($query);

    return $result;
}
/**
 * This function returns the project image associated with the most recent project in a course.
 */
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
/**
 * Given a particular course, this function will return a list of projects done for that course, ordered by most recent.
 */
function getCourseProjects($course_id)
{
    $query = "SELECT
        course_id, `course`.slug AS course_slug, project_id, ordered_value,
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

/******************************************************************************/
/** Blog Post Functions *******************************************************/
/******************************************************************************/
function getPublishedPosts()
{
    global $conn;

    $query = "SELECT * FROM `post` WHERE `published`=TRUE ORDER BY `created_at` DESC";
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
function getPostBySlug($request_slug)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM `post` WHERE `slug`=? LIMIT 1");
    $stmt->bind_param("s", $post_slug);

    $post_slug = $request_slug;
    $stmt->execute();

    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if(!$result) exit("No rows");

    return $result[0];
}
function getPost($slug)
{
    global $conn;

    $query = "SELECT * FROM `post` WHERE `slug`=? LIMIT 1";

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

function getProject($project_slug)
{
    $query = "SELECT * FROM `projects` WHERE `slug`='$project_slug' LIMIT 1";

    return returnRows($query)[0];
}
function getProjectPosts($project_id)
{    
    $query = "SELECT 
        blog_post.name AS name,
        blog_post.summary AS summary,
        blog_post.image AS image,
        blog_post.slug AS slug,
        blog_post.created_at AS created_at,
        directly_related,
        ordered_value FROM `project_posts` 
    INNER JOIN `blog_post`
        ON project_posts.blog_id=blog_post.id
    WHERE project_id=$project_id
    ORDER BY ordered_value";

    return returnRows($query);
}
function getNumRelatedPosts($project_id, $direct)
{
    $query = "SELECT COUNT(directly_related) AS cnt FROM `project_posts` WHERE project_id=$project_id AND directly_related=$direct";

    return returnRows($query)[0];
}

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