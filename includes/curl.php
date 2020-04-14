<?php
$getLargeImageId = isset($_GET['image']) ? (int)$_GET['image'] : 0;

$my_curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($my_curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost:8888/FMA/includes/data.php?image=' . $getLargeImageId,
/*    CURLOPT_URL => 'https://titan.dcs.bbk.ac.uk/~rmorle01/FMA/includes/large-image-data.php?image=' . $getLargeImageId,*/
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