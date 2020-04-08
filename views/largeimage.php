<?php

/*
 * This will then render the home's page title and header two.
 *
 * This will also load the summary of the total number of active artists and songs from the database.
 */
$page_title = "Image Preview";
$page_headerOne = "Full View";

require_once 'includes/header.php';
require_once 'includes/resize.php';


$getBigImg = isset($_GET['image']) ? (int)$_GET['image'] : 0;
$sql = "select 
        id as id,
        file_name as file,
        title as title,
        description as description
        from
        images
        where id ='" . $getBigImg . "'";

if ($getBigImg > 0) {
    $results = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($results);
    if ($row['file'] != null && file_exists("uploads/" . $row['file'])) {
        list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($row['file']), $config['upload_dir'] . htmlentities($row['file']), 600, 600, 80);
        if ($img) {
            echo "<h2>" . htmlentities($row['title']) . "</h2>";
            echo "<p>" . htmlentities($row['description']) . "</p>";
            echo "<a href='?page=home'><img src='uploads/" . htmlentities($row['file']) . "'width='" . $width . "' height='" . $height . "'/>";
        } else {
            echo $error;
        }
    } else {
        echo "<h2>Sorry, this file does not exist!</h2>";
    }
}





