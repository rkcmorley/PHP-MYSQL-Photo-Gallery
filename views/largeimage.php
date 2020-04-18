<?php
// The resize.php will load the the resize function to change the image size into a larger version.
// The languages.php will activate the language translation for this page.
// The curl.php will run the decoding process of the JSON data which will be converted into a PHP array.
include 'includes/resize.php';
include 'includes/languages.php';
include "includes/curl.php";

// These are the result of a decoded JSON data. It's converted into a PHP array and each of them are the keys
// that holds the values of the file name, title, description, height and width.
$file = $data['file'];
$title = $data['title'];
$description = $data['description'];
$height = $data['height'];
$width = $data['width'];

// If the file name isn't null or it exist in the uploads folder, then it will start resizing the chosen image.
if ($file != null && file_exists("images/uploads/" . $file)) {
    // The function, img_resize, will get the input image from the uploads folder and it will output the image file into the uploads folder. This will resize the image into 600 pixels in width or height. It will also set the image quality to 100%.
    list($img, $error, $width, $height) = image_resize($config['upload_dir'] . htmlentities($file), $config['upload_dir'] . htmlentities($file), 600, 600, 100);
    // If the image resize is successful, it will render the title, the file name, the width, height and description.
    if ($img) {
        echo "<h2>" . htmlentities($title) . "</h2>";
        echo "<a class='largeImage' href='?page=home'><img src='images/uploads/" . htmlentities($file) . "' width='" . $width . "' height='" . $height . "' alt='" . $description . "'/>" . "</a>";
        echo "<p>" . htmlentities($description) . "</p>";
    } else {
        // If it fails, it will show the error message.
        echo $error;
    }
} else {
    // If the file isn't found, then this error message will show up.
    echo "Sorry, this file does not exist!";
}







