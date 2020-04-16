<?php
include 'includes/resize.php';
include 'includes/languages.php';
include "includes/curl.php";

$file = $data['file'];
$title = $data['title'];
$description = $data['description'];
$height = $data['height'];
$width = $data['width'];

if ($file != null && file_exists("images/uploads/" . $file)) {
    list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($file), $config['upload_dir'] . htmlentities($file), 600, 600, 100);
    if ($img) {
        echo "<h2>" . htmlentities($title) . "</h2>";
        echo "<a class='largeImage' href='?page=home'><img src='images/uploads/" . htmlentities($file) . "' width='" . $width . "' height='" . $height . "' alt='" . $description . "'/>" . "</a>";
        echo "<p>" . htmlentities($description) . "</p>";
    } else {
        echo $error;
    }
} else {
    echo "Sorry, this file does not exist!";
}







