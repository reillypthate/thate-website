<?php

/**
 * Returns an array of all projects from the `projects` table in the `thate-website` database.
 * 
 */
function getAllProjects()
{
    /*
    $query = "SELECT 
        project_posts.project_id, 
        blog_id, 
        portfolio_scope.name AS 'scope', 
        blog_post.name, 
        blog_post.summary, 
        blog_post.published, 
        blog_post.image FROM project_posts 
        INNER JOIN project ON (project.id=project_id) 
        INNER JOIN portfolio_scope ON (project.portfolio_scope_id=portfolio_scope.id)
        INNER JOIN blog_post ON (blog_post.id=blog_id) 
        ORDER BY project.id DESC";
    
    return returnRows($query);
    */

    $query = "SELECT
        `id`,
        `name`,
        `summary`,
        `image`,
        `published` FROM `projects`
        ORDER BY created_at DESC";
    return returnRows($query);
}


/******************************************************************************
 ** Project Manager | Variables & Functions ***********************************
 ******************************************************************************/

$isEditingProject = false;
$project_id = 0;

$project_banner = 0;
$project_name = "";
$project_summary = "";
$project_body = "";
$project_published = 0;

$project_scope = 0;
$project_course = 0;

if(isset($_POST['create_project']))
{
    createProject($_POST);
}

if(isset($_GET['edit-project']))
{
    $isEditingProject = true;
    $project_id = $_GET['edit-project'];
    
    editProject($project_id);
}
if(isset($_POST['update_project']))
{
    $isEditingProject = false;

    updateProject($_POST);
}
if(isset($_GET['delete-project']))
{
    deleteProject($_GET['delete-project']);
}

function createProject($request_values)
{
    global $conn, $errors, 
    $project_banner,
    $project_name, 
    $project_summary, 
    $project_body, 
    $project_published, 
    $project_scope,
    $project_course;

    $project_banner = $request_values['project_banner'];
    $project_name = esc($request_values['project_name']);
    $project_summary = esc($request_values['project_summary']);
    $project_body = esc($request_values['project_body']);
    if(isset($request_values['project_published']))
    {
        $project_published = 1;
    }else
    {
        $project_published = 0;
    }
    $project_scope = $request_values['project_scope'];
    if($project_scope == 1)
    {
        $project_course = $request_values['project_course'];
        if(empty($project_course))
        {
            array_push($errors, "Academic scope: Course required");
        }
    }

    if(empty($project_banner))
    {
        array_push($errors, "Project banner required");
    }
    if(empty($project_name))
    {
        array_push($errors, "Project name required");
    }
    if(empty($project_summary))
    {
        array_push($errors, "Project summary required");
    }
    if(empty($project_body))
    {
        array_push($errors, "Project body required");
    }


    if(count($errors) == 0)
    {
        $meta_name = "Project: " . $project_name;
        $slug = makeSlug($project_name);
        
        $query = "INSERT INTO projects (name, meta_name, slug, summary, image, published, created_at, body) VALUES
        ('$project_name', '$meta_name', '$slug', '$project_summary', $project_banner, $project_published, now(), '$project_body')";
        
        mysqli_query($conn, $query);

        $query = "SELECT id FROM `projects` WHERE slug='$slug'";
        $result = mysqli_query($conn, $query);
        $id_array = mysqli_fetch_assoc($result);
        $id = $id_array['id'];
        if($project_scope == 1)
        {
            $query2 = "INSERT INTO `project_scope` (project_id, scope_id) VALUES ($id, $project_scope)"; 
            mysqli_query($conn, $query2);
            
            $query3 = "INSERT INTO `project_academic_scope` (project_id, course_id, institution_id) VALUES ($id, $project_course, NULL)";
            mysqli_query($conn, $query3);
        }else
        {
            $query = "INSERT INTO `project_scope` (project_id, scope_id) VALUES ($id, $project_scope)";
            mysqli_query($conn, $query);
        }

    }
}

function editProject($project_id)
{
    global $conn, $errors, 
    $project_banner,
    $project_name, 
    $project_summary, 
    $project_body, 
    $project_published, 
    $project_scope,
    $project_course;

    $query = "SELECT * FROM projects WHERE id=$project_id LIMIT 1";
    $query = "SELECT 
        name, 
        summary, 
        body, 
        published, 
        image, 
        scope_id FROM projects
        INNER JOIN `project_scope` ON (projects.id=project_id)
        WHERE projects.id=$project_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $project = mysqli_fetch_assoc($result);

    $project_name = $project['name'];
    $project_summary = $project['summary'];
    $project_body = $project['body'];
    $project_published = $project['published'];
    $project_banner = $project['image'];
    $project_scope = $project['scope_id'];

    if($project_scope == 1)
    {
        $query2 = "SELECT course_id FROM `project_academic_scope` WHERE project_id=$project_id LIMIT 1";
        $result2 = mysqli_query($conn, $query2);
        
        $course = mysqli_fetch_assoc($result2);
        $project_course = $course['course_id'];
    }else
    {

    }
    
    return;
}

function updateProject($request_values)
{
    global $conn, $errors, 
    $project_banner,
    $project_name, 
    $project_summary, 
    $project_body, 
    $project_published, 
    $project_scope,
    $project_course;

    $project_banner = $request_values['project_banner'];
    $project_name = esc($request_values['project_name']);
    $project_summary = esc($request_values['project_summary']);
    $project_body = esc($request_values['project_body']);
    if(isset($request_values['project_published']))
    {
        $project_published = 1;
    }else
    {
        $project_published = 0;
    }
    $project_scope = $request_values['project_scope'];
    if($project_scope == 1)
    {
        $project_course = $request_values['project_course'];
        echo $project_course;
        if(empty($project_course))
        {
            array_push($errors, "Academic scope: Course required");
        }
    }

    if(empty($project_banner))
    {
        array_push($errors, "Project banner required");
    }
    if(empty($project_name))
    {
        array_push($errors, "Project name required");
    }
    if(empty($project_summary))
    {
        array_push($errors, "Project summary required");
    }
    if(empty($project_body))
    {
        array_push($errors, "Project body required");
    }


    if(count($errors) == 0)
    {
        $meta_name = "Project: " . $project_name;
        $slug = makeSlug($project_name);
        
        $query_scope = "UPDATE project_scope SET scope_id=$project_scope WHERE project_id=" . $request_values['project_id'] . "";
        mysqli_query($conn, $query_scope);
        if($project_scope == 1)
        {
            $query_academic = "UPDATE project_academic_scope SET course_id=$project_course WHERE project_id=" . $request_values['project_id'] . "";
            mysqli_query($conn, $query_academic);
        }else
        {
            $query_academic = "DELETE FROM project_academic_scope WHERE project_id=" . $request_values['project_id'] . "";
            mysqli_query($conn, $query_academic);
        }
        $query = "UPDATE projects SET 
            name='$project_name',
            meta_name='$meta_name',
            slug='$slug',
            summary='$project_summary',
            body='$project_body',
            image=$project_banner,
            published=$project_published,
            updated_at=now()
            WHERE id=" . $request_values['project_id'] . "";
        
        mysqli_query($conn, $query);

    }
    return;
    global $conn, $errors, $project_blog, $project_scope, $projectCourse;

    $project_blog = $request_values['project_blog'];
    $project_scope = $request_values['portfolio_scope'];
    $projectCourse = $request_values['project_course'];

    if($project_scope == 1)
    {
        $projectCourse = $request_values['project_course'];
        if(empty($request_values['project_course']))
        {
            array_push($errors, "Academic project -- Course required");
        }
    }else
    {
        
    }
    
    if(count($errors) == 0)
    {
        $query = "UPDATE project SET blog_id=$project_blog, portfolio_scope_id=$project_scope WHERE id=" . $request_values['project_id'] . "";
        
        mysqli_query($conn, $query); 
        if($request_values['no_course'])
        {
            echo "Inserted THIS!";
            $query = "INSERT INTO project_academic_scope (project_id, course_id)VALUES (".$request_values['project_id'].", $projectCourse)";
        }else
        {
            echo "Updated THIS!";
            $query = "UPDATE project_academic_scope SET course_id=$projectCourse WHERE project_id=" . $request_values['project_id'] . "";
        }
        mysqli_query($conn, $query); 
        $projectCourse = 0;

        $_SESSION['message'] = "Project successfully updated";
        header("location: project_manager.php");
        exit(0);
    }
}

function deleteProject($project_id)
{
    global $conn;

    $query_scope = "DELETE FROM `project_scope` WHERE project_id=$project_id";
    $query_academic = "DELETE FROM `project_academic_scope` WHERE project_id=$project_id";
    $query_projects = "DELETE FROM projects WHERE id=$project_id";

    mysqli_query($conn, $query_scope);
    mysqli_query($conn, $query_academic);
    if(mysqli_query($conn, $query_projects))
    {
        $_SESSION['message'] = "Project successfully deleted";
        header("location: project_manager.php");
        exit(0);
    }
}


/******************************************************************************
 ** Course Manager | Variables & Functions ************************************
 ******************************************************************************/
function getAllCourses()
{
    global $conn;

    /*
    $sql = "SELECT project.id, project.blog_id, name, summary, image FROM project INNER JOIN blog_post ON (project.blog_id=blog_post.id) ORDER BY project.id DESC";*/

    $sql = "SELECT * FROM course ORDER BY name";
    $result = mysqli_query($conn, $sql);
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_projects = array();
    foreach($projects as $project)
    {
        array_push($final_projects, $project);
    }
    return $final_projects;
}
function getProjectCourse($project_id)
{
    global $conn;

    $sql = "SELECT * FROM project_academic_scope INNER JOIN course ON (course_id=course.id) WHERE project_id=$project_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_projects = array();
    foreach($projects as $project)
    {
        array_push($final_projects, $project);
    }
    foreach($final_projects as $project)
    {
        return $project['name'];
    }
}

/******************************************************************************
 ** Course Manager | Variables & Functions ************************************
 ******************************************************************************/

?>