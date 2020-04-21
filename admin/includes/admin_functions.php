<?php

// General variables
$errors = [];

// Escapes form submitted value, hence, preventing SQL injection
function esc(String $value)
{
    // bring the global db connect object into function
    global $conn;
    // remove empty space surrounding string
    $val = trim($value);
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}
// Receives a string like "some sample string' and returns 'some-sample-string'
function makeSlug(String $string)
{
    $string = strtolower($string);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}
/******************************************************************************
 ** Category Manager | Variables & Functions **********************************
 ******************************************************************************/

$category_id = 0;
$isEditingCategory = false;
$category_name = "";

// If user clicks the "Create Category" button...
if (isset($_POST['create_category'])) { createCategory($_POST); }
// If user clicks the "Edit Category" button...
if (isset($_GET['edit-category'])) {
    $isEditingCategory = true;
    $category_id = $_GET['edit-category'];
    editCategory($category_id);
}
// If user clicks the "Update Topic" button...
if (isset($_POST['update_category']))
{
    updateCategory($_POST);
}
// If user clicks the "Delete Topic" button...
if (isset($_GET['delete-category']))
{
    $category_id = $_GET['delete-category'];
    deleteCategory($category_id);
}
// Get all categories from DB
function getAllCategories()
{
    global $conn;

    $sql = "SELECT * FROM category";

    $result = mysqli_query($conn, $sql);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
}

function createCategory($request_values)
{
    global $conn, $errors, $category_name;
    $category_name = esc($request_values['category_name']);
    // Create slug: if category is "Life Advice", return "life-advice" as slug.
    $category_slug = makeSlug($category_name);
    // Validate form
    if(empty($category_name))
    {
        array_push($errors, "Category name required");
    }
    // Ensure that no category is saved twice.
    $category_check_query = "SELECT * FROM category WHERE slug='$category_slug' LIMIT 1";
    $result = mysqli_query($conn, $category_check_query);
    if(mysqli_num_rows($result) > 0)
    {
        array_push($errors, "Category already exists");
    }
    // Register category if there are no errors in the form
    if(count($errors) == 0)
    {
        $query = "INSERT INTO category (title, slug) VALUES('$category_name', '$category_slug')";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Category created successfully";
        header('location: category_manager.php');
        exit(0);
    }

}
function editCategory($category_id)
{
    global $conn, $category_name, $isEditingCategory, $category_id;
    $sql = "SELECT * FROM category WHERE id=$category_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

    $category_name = $category['title'];
}
function updateCategory($request_values)
{
    global $conn, $errors, $category_name, $category_id;
    $category_name = esc($request_values['category_name']);
    $category_id = esc($request_values['category_id']);
    $category_slug = makeSlug($category_name);
    if(empty($category_name))
    {
        array_push($errors, "Category name required");
    }
    if(count($errors) == 0)
    {
        $query = "UPDATE category SET title='$category_name', slug='$category_slug' WHERE id=$category_id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Category updated successfully";
        header('location: category_manager.php');
        exit(0);
    }
}
function deleteCategory($category_id)
{
    global $conn;
    $sql = "DELETE FROM category WHERE id=$category_id";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['message'] = "Topic successfully deleted";
        header("location: category_manager.php");
        exit(0);
    }
}
function getCategoryCount()
{
    global $conn;

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    $row_cnt = mysqli_num_rows($result);
    return $row_cnt;
}

/******************************************************************************
 ** Tag Manager | Variables & Functions **********************************
 ******************************************************************************/

$tag_id = 0;
$isEditingTag = false;
$tag_name = "";

// If user clicks the "Create Tag" button...
if (isset($_POST['create_tag'])) { createTag($_POST); }
// If user clicks the "Edit Tag" button...
if (isset($_GET['edit-tag'])) {
    $isEditingTag = true;
    $tag_id = $_GET['edit-tag'];
    editTag($tag_id);
}
// If user clicks the "Update Topic" button...
if (isset($_POST['update_tag']))
{
    updateTag($_POST);
}
// If user clicks the "Delete Topic" button...
if (isset($_GET['delete-tag']))
{
    $tag_id = $_GET['delete-tag'];
    deleteTag($tag_id);
}
// Get all tags from DB
function getAllTags()
{
    global $conn;

    $sql = "SELECT * FROM tag";

    $result = mysqli_query($conn, $sql);
    $tags = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $tags;
}

function createTag($request_values)
{
    global $conn, $errors, $tag_name;
    $tag_name = esc($request_values['tag_name']);
    // Create slug: if tag is "Life Advice", return "life-advice" as slug.
    $tag_slug = makeSlug($tag_name);
    // Validate form
    if(empty($tag_name))
    {
        array_push($errors, "Tag name required");
    }
    // Ensure that no tag is saved twice.
    $tag_check_query = "SELECT * FROM tag WHERE slug='$tag_slug' LIMIT 1";
    $result = mysqli_query($conn, $tag_check_query);
    if(mysqli_num_rows($result) > 0)
    {
        array_push($errors, "Tag already exists");
    }
    // Register tag if there are no errors in the form
    if(count($errors) == 0)
    {
        $query = "INSERT INTO tag (title, slug) VALUES('$tag_name', '$tag_slug')";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Tag created successfully";
        header('location: tag_manager.php');
        exit(0);
    }

}
function editTag($tag_id)
{
    global $conn, $tag_name, $isEditingTag, $tag_id;
    $sql = "SELECT * FROM tag WHERE id=$tag_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $tag = mysqli_fetch_assoc($result);

    $tag_name = $tag['title'];
}
function updateTag($request_values)
{
    global $conn, $errors, $tag_name, $tag_id;
    $tag_name = esc($request_values['tag_name']);
    $tag_id = esc($request_values['tag_id']);
    $tag_slug = makeSlug($tag_name);
    if(empty($tag_name))
    {
        array_push($errors, "Tag name required");
    }
    if(count($errors) == 0)
    {
        $query = "UPDATE tag SET title='$tag_name', slug='$tag_slug' WHERE id=$tag_id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Tag updated successfully";
        header('location: tag_manager.php');
        exit(0);
    }
}
function deleteTag($tag_id)
{
    global $conn;
    $sql = "DELETE FROM tag WHERE id=$tag_id";
    if(mysqli_query($conn, $sql))
    {
        $_SESSION['message'] = "Topic successfully deleted";
        header("location: tag_manager.php");
        exit(0);
    }
}
function getTagCount()
{
    global $conn;

    $sql = "SELECT * FROM tag";
    $result = mysqli_query($conn, $sql);
    $row_cnt = mysqli_num_rows($result);
    return $row_cnt;
}
function getBlogCount()
{
    global $conn;
    
    $sql = "SELECT * FROM `blog_post`";
    $result = mysqli_query($conn, $sql);
    $row_cnt = mysqli_num_rows($result);
    return $row_cnt;
}

?>