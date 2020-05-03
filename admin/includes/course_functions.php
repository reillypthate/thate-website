<?php

/**
 * Return an array of all the `course` rows.
 */
function getAllCourses()
{
    return returnRows("SELECT * FROM `course` ORDER BY name");
}

/******************************************************************************
 ** Associates Functions | Variables & Functions ******************************
 ******************************************************************************/

function getProjectsFromCourse($course_id)
{
    $query = "SELECT 
    `course`.`name` AS course_name, 
    `project`.`name` AS project_name, 
    `ordered_value` 
    FROM `course` 
    INNER JOIN `course_projects`
    ON `course_id`=`course`.`id`
    INNER JOIN `project`
    ON `project`.`id`=`project_id`
    WHERE `course`.`id`=$course_id";

    return returnRows($query);
}
function getBlogsFromCourse($course_id)
{
    $query = "SELECT 
    `course`.`name` AS course_name, 
    `blog_post`.`name` AS blog_name, 
    `ordered_value` 
    FROM `course` 
    INNER JOIN `course_projects`
    ON `course_id`=`course`.`id`
    INNER JOIN `blog_post`
    ON `blog_post`.`id`=`blog_id`
    WHERE `course`.`id`=$course_id AND 'blog_id' IS NOT NULL";

    return returnRows($query);
}

$isEditingProjects = false;
$order_switcher = array();

if(isset($_GET['edit-projects']))
{
    $isEditingProjects = true;
    $course_id = $_GET['edit-projects'];

}
if(isset($_GET['clear-projects']))
{
    clearProjectsFromCourse($_GET['clear-projects']);
}

function clearProjectsFromCourse($course_id)
{
    global $conn;

    $query = "DELETE FROM `course_projects` WHERE `course_id`=$course_id";

    if(mysqli_query($conn, $query))
    {
        $_SESSION['message'] = "Projects successfully cleared";
        header("location: course_manager.php");
        exit(0);
    }
}

/******************************************************************************
 ** Form Functions | Variables & Functions ************************************
 ******************************************************************************/
$isEditingCourse = false;
$course_id = 0;
$course_name = "";
$course_summary = "";
$course_meta_name = "";
$course_slug = "";

if(isset($_POST['create_course']))
{
    createCourse($_POST);
}

if(isset($_GET['edit-course']))
{
    $isEditingCourse = true;
    $course_id = $_GET['edit-course'];
    
    editCourse($course_id);
}
if(isset($_POST['update_course']))
{
    $isEditingCourse = false;
    $course_name = "";
    $course_summary = "";

    updateCourse($_POST);
}
if(isset($_GET['delete-course']))
{
    deleteCourse($_GET['delete-course']);
}
/**
 * Add a row to the `course` table.
 * 
 * Version 1: Take the Course Name and Course Summary, and if they exist, convert them to a meta_name and slug for the empty columns in the table.
 */
function createCourse($request_values)
{
    global $conn, $errors, $course_name, $course_summary;

    $course_name = esc($request_values['course_name']);
    $course_summary = esc($request_values['course_summary']);

    // Validate Form
    // --> Course Name
    if(empty($course_name))
    {
        array_push($errors, "Course Name required");
    }
    // --> Course Summary
    if(empty($course_summary))
    {
        array_push($errors, "Course Summary required");
    }

    if(count($errors) == 0)
    {
        $course_meta_name = "Course - " . $course_name;
        $course_slug = makeSlug($course_name);

        $query = 
        "INSERT INTO `course` (name, meta_name, slug, summary)
            VALUES ('$course_name', '$course_meta_name', '$course_slug', '$course_summary')";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Course added successfully!";
        header('location: course_manager.php');
        exit(0);
    }
}

/**
 * Initialize variables for use in the "Edit Course" section.
 */
function editCourse($course_id)
{
    global $conn, $course_name, $course_summary, $course_meta_name, $course_slug;

    $query = "SELECT * FROM `course` WHERE id=$course_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $course = mysqli_fetch_assoc($result);

    $course_name = $course['name'];
    $course_summary = $course['summary'];
    $course_meta_name = $course['meta_name'];
    $course_slug = $course['slug'];
}
/**
 * Update elements in a specific row of `course`.
 */
function updateCourse($request_values)
{
    global $conn, $errors, $course_name, $course_summary, $course_meta_name, $course_slug;

    $course_name = esc($request_values['course_name']);
    $course_summary = esc($request_values['course_summary']);

    // Validate Form
    // --> Course Name
    if(empty($course_name))
    {
        array_push($errors, "Course Name required");
    }
    // --> Course Summary
    if(empty($course_summary))
    {
        array_push($errors, "Course Summary required");
    }

    if(count($errors == 0))
    {
        $course_meta_name = "Course - " . $course_name;
        $course_slug = makeSlug($course_name);

        $query = 
        "UPDATE `course` SET
            `name`='$course_name',
            `summary`='$course_summary',
            `meta_name`='$course_meta_name',
            `slug`='$course_slug' WHERE
            `id`=" . $request_values['course_id'] . "";

        mysqli_query($conn, $query);
        
        $_SESSION['message'] = "Course successfully updated";
        header("location: course_manager.php");
        exit(0);
    }
}
/**
 * Delete a row from `course`.
 */
function deleteCourse($course_id)
{
    global $conn;

    $query = "DELETE FROM `course` WHERE `id`=$course_id";

    if(mysqli_query($conn, $query))
    {
        $_SESSION['message'] = "Course successfully deleted";
        header("location: course_manager.php");
        exit(0);
    }
}
?>