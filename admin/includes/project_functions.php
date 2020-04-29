<?php

// Project Variables

function getAllProjects()
{
    global $conn;

    /*
    $sql = "SELECT project.id, project.blog_id, name, summary, image FROM project INNER JOIN blog_post ON (project.blog_id=blog_post.id) ORDER BY project.id DESC";*/

    $sql = "SELECT project.id, project.blog_id, portfolio_scope.name AS 'scope', blog_post.name, summary, published, image FROM project INNER JOIN blog_post ON (project.blog_id=blog_post.id) INNER JOIN portfolio_scope ON (project.portfolio_scope_id=portfolio_scope.id) ORDER BY project.id DESC";
    $result = mysqli_query($conn, $sql);
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_projects = array();
    foreach($projects as $project)
    {
        array_push($final_projects, $project);

    }
    return $final_projects;
}


/******************************************************************************
 ** Project Manager | Variables & Functions ***********************************
 ******************************************************************************/

$isEditingProject = false;
$projectId = 0;
$projectBlogId = 0;
$projectScope = 0;
$projectCourse = 0;
$noCourse = false;

if(isset($_POST['create_project']))
{
    createProject($_POST);
}

if(isset($_GET['edit-project']))
{
    $isEditingProject = true;
    $projectId = $_GET['edit-project'];
    
    editProject($projectId);
}
if(isset($_POST['update_project']))
{
    $isEditingProject = false;
    $projectId = 0;
    $projectBlogId = 0;
    $projectScope = 0;
    $projectCourse = 0;

    updateProject($_POST);
}
if(isset($_GET['delete-project']))
{
    deleteProject($_GET['delete-project']);
}

function createProject($request_values)
{
    global $conn, $errors, $project_blog, $project_scope;

    $project_blog = $request_values['project_blog'];
    $project_scope = $request_values['portfolio_scope'];

    if(count($errors) == 0)
    {
        $query = "INSERT INTO project (blog_id, portfolio_scope_id) VALUES ($project_blog, $project_scope)";
        
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Project created successfully!";
        header('location: project_manager.php');
        exit(0);
    }
}

function editProject($project_id)
{
    global $conn, $isEditingProject, $projectId, $projectBlogId, $projectScope, $noCourse, $projectCourse;

    $query = "SELECT * FROM project WHERE id=$project_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $project = mysqli_fetch_assoc($result);

    $projectId = $project['id'];
    $projectBlogId = $project['blog_id'];
    $projectScope = $project['portfolio_scope_id'];
    if($projectScope == 1)
    {
        $query2 = "SELECT project.id, blog_id, portfolio_scope_id, course_id FROM project INNER JOIN project_academic_scope ON (project.id=project_academic_scope.project_id) WHERE id=$project_id LIMIT 1";
        $query2 = "SELECT * FROM project_academic_scope WHERE project_id=$projectId";
        $result2 = mysqli_query($conn, $query2);
        
        if(mysqli_num_rows($result2) > 0)
        {
            $X = mysqli_fetch_assoc($result2);
            $projectCourse = $X['course_id'];
            $noCourse = false;
        }else
        {
            $noCourse = true;
        }
    }
}

function updateProject($request_values)
{
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

    $query = "DELETE FROM project WHERE id=$project_id";

    if(mysqli_query($conn, $query))
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
?>