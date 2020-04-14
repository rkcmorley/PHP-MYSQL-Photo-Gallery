<?php
require_once 'includes/resize.php';
require_once 'includes/languages.php';
$getLargeImgId = isset($_GET['image']) ? (int)$_GET['image'] : 0;

// Get cURL resource
$my_curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($my_curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:8888/FMA/includes/large-image-data.php?image=' .$getLargeImgId,
    CURLOPT_USERAGENT => 'Sample cURL Request'
));

// Send the request & save response to $resp
$resp = curl_exec($my_curl);

$data = '';
// Get the error codes and messages
if (curl_errno($my_curl)) {
    echo 'Code: ' . curl_errno($my_curl);
    echo 'Message: ' . curl_error($my_curl);
} else {
    // Decode the response & process it
    $data = json_decode($resp, true);
}

// Get array of info about the transfer
$info = curl_getinfo($my_curl);

// Close request to clear up some resources
curl_close($my_curl);

$file = $data['file'];
$title = $data['title'];
$description = $data['description'];
$height = $data['height'];
$width = $data['width'];

if ($getLargeImgId > 0) {
    if ($file != null && file_exists("uploads/" . $file)) {
        list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($file), $config['upload_dir'] . htmlentities($file), 600, 600, 100);
        if ($img) {
            echo "<h2>" . htmlentities($title) . "</h2>";
            echo "<p>" . htmlentities($description) . "</p>";
            echo "<a href='?page=home'><img src='uploads/" . htmlentities($file) . "'width='" . $width . "' height='" . $height . "'/>";
        } else {
            echo $error;
        }
    } else {
        echo "<h2>Sorry, this file does not exist!</h2>";
    }
}







