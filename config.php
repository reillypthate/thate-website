<?php 
    session_start();

    $adminEnabled = true;

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database = "thate-website";

    $conn = new mysqli($server_name, $username, $password, $database);

    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    
    define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://localhost/thate-website/');
    // This is the directory we'll be using to dynamically generate a static website.
    define('STATIC_PATH', realpath(dirname(__FILE__, 2) . "/thate-website-static/"));
    
    /*
	// connect to database
    $conn = mysqli_connect("localhost", "root", "", "thate-website");

    if(!$conn)
    {
        die("Error connecting to database: " . mysqli_connect_error());
    }
    */
?>