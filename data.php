<?php
// This will go through the config.php and openSQL.php to open and log into the database.
require __DIR__ . '/config.php';
require __DIR__ . '/openSQL.php';

// This will tell the content-type header that it will receive a JSON data.
header('Content-type: application/json');

// This will get the ID of the image, it will check whether the ID exist in the URL or not.
$getLargeImageId = isset($_GET['image']) ? (int)$_GET['image'] : 0;

// Generate sql based on query string params
if (isset($_GET['image'])) {
    // Construct the query based on the ID number of the selected image.
    $sql = "select 
        file_name as file,
        title as title,
        description as description,
        height as height,
        width as width
        from
        images
        where id ='" . $getLargeImageId . "'";
} else {
    //If it fails to find one, it will generate an error.
    echo "Invalid parameter.";
}

//If the query has been set, it will do the following.
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
        // Make result turn into an array of JSON objects
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
// This will close the database once it's done with the query.
require __DIR__ . '/closeSQL.php';