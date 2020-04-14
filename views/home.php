<?php

include 'includes/resize.php';
include 'includes/languages.php';
require 'includes/openSQL.php';

$sql = "select 
        id as id,
        file_name as file,
        title as title
        from
        images";

/*
 * This will perform a query on the database.
 */
$result = mysqli_query($link, $sql);

/*
 * If it fails, it will show an error message.
 */
if ($result === false) {
    echo mysqli_error($link);
}

while ($row = mysqli_fetch_assoc($result)) {
    list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($row['file']), $config['thumbnails_dir'] . "small_" . htmlentities($row['file']), 150, 150, 80);
    if ($img) {
        echo "<h2>" . htmlentities($row['title']) . "</h2>";
        echo "<a href='index.php?page=largeimage&image=" . htmlentities($row['id']) ."'><img src='thumbnails/" . "small_" . htmlentities($row['file']) . "' width='" . $width . "' height='" . $height . "' alt='" . htmlentities($row['title'])  . "'/>" . "</a>";
    } else {
        echo $error;
    }
}

require 'includes/closeSQL.php';