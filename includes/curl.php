<?php
// This will get the ID of the image, it will check whether the ID exist in the URL or not.
$getLargeImageId = isset($_GET['image']) ? (int)$_GET['image'] : 0;

// This will initialise cURL.
$my_curl = curl_init();

// Set some options for the cURL setup.
curl_setopt_array($my_curl, array(
    // Tell cURL to quit if server does not respond in 5 secs.
    CURLOPT_CONNECTTIMEOUT => 5,
    // Tell cURL to quit if server script takes more than 2 secs to complete.
    CURLOPT_TIMEOUT => 2,
    // Tell cURL to quit if it encounters a 404 error or similar.
    CURLOPT_FAILONERROR => true,
    // This will return the response as a string.
    CURLOPT_RETURNTRANSFER => 1,
    // It will also find the URL that contains the data.
    CURLOPT_URL => 'https://titan.dcs.bbk.ac.uk/~rmorle01/w1fma/includes/data.php?image=' . $getLargeImageId
));

// Send the request & save response to $resp
$resp = curl_exec($my_curl);

//This will obtain the decoded JSON object which will be converted into a PHP array.
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