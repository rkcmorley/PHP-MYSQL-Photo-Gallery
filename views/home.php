<?php
// The resize.php will load the the resize function to change the image sizes into thumbnails.
// The languages.php will activate the language translation for this page.
// The openSQL.php will open the database.
include 'includes/resize.php';
include 'includes/languages.php';
require 'includes/openSQL.php';

// This will select a query where it will select the ID, file name, title and description from
// the database, images.
$sql = "select 
        id as id,
        file_name as file,
        title as title,
        description as description
        from
        images";


// This will perform a query on the database.
$result = mysqli_query($link, $sql);

// If it fails, it will show an error message.
if ($result === false) {
    echo mysqli_error($link);
}

// This will fetch each row from the database. Each row contains the ID, file name, title and description.
while ($row = mysqli_fetch_assoc($result)) {
    //The function, img_resize, will get the input image from the uploads folder and it will output the image file into the thumbnails folder. This will resize the thumbnail image into 150 pixels in width or height. It will also set the image quality to 80%.
    list($img, $error, $width, $height) = image_resize($config['upload_dir'] . htmlentities($row['file']), $config['thumbnails_dir'] . "small_" . htmlentities($row['file']), 150, 150, 80);
    //If the image resize is successful, it will render the title, the ID, the file name, the width, height and description.
    if ($img) {
        echo "<h2>" . htmlentities($row['title']) . "</h2>";
        echo "<a href='index.php?page=largeimage&image=" . htmlentities($row['id']) ."'><img src='images/thumbnails/" . "small_" . htmlentities($row['file']) . "' width='" . $width . "' height='" . $height . "' alt='" . htmlentities($row['description'])  . "'/>" . "</a>";
    } else {
        //If it fails, it will show the error message.
        echo $error;
    }
}

require 'includes/closeSQL.php';