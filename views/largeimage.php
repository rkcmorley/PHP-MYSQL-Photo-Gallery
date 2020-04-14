<?php
include 'includes/resize.php';
$page_title = $lang['home_title'];
$page_heading = $lang['home_heading'];
$home_link = $lang['home_link'];
$upload_link = $lang['upload_link'];

$header = file_get_contents('templates/header.html');
$header = str_replace('[+home+]', $home_link, $header);
$header = str_replace('[+upload+]', $upload_link, $header);
$header = str_replace('[+page_title+]', $page_title, $header);
$header = str_replace('[+page_heading+]', $page_heading, $header);
echo $header;

$getLargeImageId = isset($_GET['image']) ? (int)$_GET['image'] : 0;

$my_curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($my_curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:8888/FMA/includes/large-image-data.php?image=' . $getLargeImageId,
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







