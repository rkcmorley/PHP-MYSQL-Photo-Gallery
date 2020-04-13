<?php
require_once __DIR__.'/config.php';
header('Content-type: application/json');

$getLargeImgId = $_GET['type'];

// Generate sql based on query string params
if ($_GET['type']) {
    // Construct the query
    $sql = "select 
        file_name as file,
        title as title,
        description as description,
        height as height,
        width as width
        from
        images
        where id ='" . $getLargeImgId . "'";
} else {
    echo "Invalid parameter.";
}

if (isset($sql)) {
    // Execute the query, assigning the result to $result
    $result = mysqli_query($link, $sql);
    // If the query failed, $result will be "false", so we test for this, and exit if it is
    if ($result === false) {
        exit("Error retrieving records from database.");
    }
    // Check if the query returned anything
    if (mysqli_num_rows($result) == 0) {
        exit("No results to display.");
    } else {
        // Make result into array of JSON objects
        $structure = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($structure, json_encode($row));
        }
        // Check for errors
        if (json_last_error() == JSON_ERROR_NONE) {
            // No errors occurred, so echo json objects
            foreach ($structure as $json) {
                echo $json;
            }
        } else {
            // Errors encountered
            echo 'Something is wrong with JSON...';
            echo 'CODE: ' . json_last_error();
        }
    }
}