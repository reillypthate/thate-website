<?php

/**
 * This function generates a head specific to the page.
 * 
 * $title - The title of the page.
 * $description - The meta description of the page.
 */
function generateHead($title, $description)
{
    $lines = array(
        "<!doctype html>",
        "<html class=\"no-js\">",
        "\t<head>",
        "\t\t<meta charset=\"utf-8\">",
        "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">",
        "",
        "\t\t<link rel=\"icon\" type=\"image/ico\" href=\"favicon.ico\" sizes=\"16x16\" />",
        //"\t\t<link rel=\"stylesheet\" href=\"static/css/common.css\" type=\"text/css\">",
        "\t\t<link rel=\"stylesheet\" href=\"static/css/scss/common-style.css\" type=\"text/css\">",
        "",
        "<!-- Unique Page Details -->",
        "\t\t<title>$title</title>",
        "\t\t<meta name=\"description\" content=\"$description\">",
        "\t</head>"
    );

    echo generateLines($lines);
}

?>