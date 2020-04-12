<?php
require_once './config.php';
header('Content-type: application/json');


// Generate sql based on query string params
// Construct the query
$sql = "select 
        id as id,
        file_name as file,
        title as title
        from
        images";

if (isset($sql)) {
    // Execute the query, assigning the result to $result
    $result = mysqli_query($link,$sql);
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
            $counter +=1;
            $structure[$counter] = ["id" => $row['id'] ,"file" => $row['file'], "title" => $row['title']];
        }
        // Check for errors
        if(json_last_error() == JSON_ERROR_NONE){
            // No errors occurred, so echo json objects
            header('Content-type: application/json');
            echo json_encode($structure);
        } else{
            // Errors encountered
            echo 'Something is wrong with JSON...';
            echo 'CODE: ' . json_last_error();
        }
    }
}