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


$getBigImg = isset($_GET['type']) ? (int)$_GET['type'] : 0;

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:8888/FMA/includes/data.php?type=' .$getBigImg,
    CURLOPT_USERAGENT => 'Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);

$data = '';
// Get the error codes and messages
if (curl_errno($curl)) {
    echo 'Code: ' . curl_errno($curl);
    echo 'Message: ' . curl_error($curl);
} else {
    // Decode the response & process it
    $data = json_decode($resp, true);
    foreach ($data as $id => $value) {
        echo '<p>ID: ' . $id . ', Value: ' . $value . '</p><br>';
    }
}


// Get array of info about the transfer
$info = curl_getinfo($curl);

// Close request to clear up some resources
curl_close($curl);

$file = $data['file'];
$title = $data['title'];
$description = $data['description'];
$height = $data['height'];
$width = $data['width'];

if ($getBigImg > 0) {
    if ($file != null && file_exists("uploads/" . $file)) {
        list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($file), $config['upload_dir'] . htmlentities($file), 600, 600, 100);
        if ($img) {
            echo "<h2>" . htmlentities($title) . "</h2>";
            echo "<p>" . htmlentities($description) . "</p>";
            echo "<a href='?page=home'><img src='uploads/" . $file. "'width='" . $width . "' height='" . $height . "'/>";
        } else {
            echo $error;
        }
    } else {
        echo "<h2>Sorry, this file does not exist!</h2>";
    }
}







