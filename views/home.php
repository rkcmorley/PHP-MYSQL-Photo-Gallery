<?php
/*
 * This will then render the home's page title and header two.
 *
 * This will also load the summary of the total number of active artists and songs from the database.
 */

require_once 'includes/resize.php';
require_once 'includes/languages.php';
// Get cURL resource
$my_curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($my_curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:8888/FMA/includes/home-data.php',
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

foreach ($data as $item) {
    $id = $item['id'];
    $file = $item['file'];
    $title = $item['title'];
    list($img, $error, $width, $height) = img_resize($config['upload_dir'] . htmlentities($file), $config['thumbnails_dir'] . "small_" . htmlentities($file), 150, 150, 80);
    if ($img) {
        echo "<h2>" . htmlentities($title) . "</h2>";
        echo "<a href='?page=largeimage&image=" . htmlentities($id) . "'><img src='thumbnails/small_" . htmlentities($file) . "'width='" . $width . "' height='" . $height . "'/>";
    } else {
        echo $error;
    }
}










