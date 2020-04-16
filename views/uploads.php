<?php

include dirname(dirname(__FILE__)) . '/includes/directories.php';
include 'includes/languages.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    if (isset($_POST['singlefileupload'])) {
        // Process the uploaded files here...
        if (strtolower(substr($_FILES['userfile']['name'], -4)) != ".jpg") {
            throw new Exception("Files must end with .jpg!");
        } else if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            $updir = dirname(dirname(__FILE__)) . '/images/' . 'uploads/';
            $upfilename = strtolower(basename($_FILES['userfile']['name'])); //original file name
            $newname = $updir . $upfilename; //concatenate file path and file name, the new name
            $tmpname = $_FILES['userfile']['tmp_name']; //old name

            $title = $_POST['title'];
            $description = $_POST['description'];
            $size = getimagesize($tmpname);
            $width = $size[0];
            $height = $size[1];

            if (!isset($title) OR trim($title) == '') {
                throw new Exception("The title is blank! Please fill it in.");
            } else if (!isset($description) OR trim($description) == '') {
                throw new Exception("The description is blank! Please write something descriptive.");
            } else if ($width == 0 OR $height <= 0) {
                throw new Exception("Unrecognised image format. It appears to be corrupted. Please format it properly then upload it in .jpg.");
            } else if ($width <= 600 OR $height <= 600) {
                throw new Exception('Image size is too small. It must be greater than 600 pixels in width and height.');
            } else if (file_exists($newname)) {
                throw new Exception("File already exists - not uploaded again");
            } else {
                if (move_uploaded_file($tmpname, $newname)) {
                    echo "File uploaded successfully!" . PHP_EOL;
                    $query = "INSERT INTO images (title, description, file_name, width, height) VALUES ('$title', '$description','$upfilename', '$width', '$height' )";
                    if (mysqli_query($link, $query)) {
                        echo "Well done!";
                    } else {
                        throw new Exception("Error: " . $query . "" . mysqli_error($link));
                    }
                } else {
                    throw new Exception("File not uploaded successfully!");
                }
            }
        } else {
            $error = $_FILES['userfile']['error'];
            if ($error == UPLOAD_ERR_FORM_SIZE) {
                throw new Exception("File upload failed - form size exceeded");
            } else if ($error == UPLOAD_ERR_PARTIAL) { //failed to upload half way through
                throw new Exception("File upload failed - partial exceeded");
            } else if ($error == UPLOAD_ERR_NO_FILE) {
                throw new Exception("File upload failed - no file supplied");
            } else {
                throw new Exception("File upload failed - error code" . $error);
            }
        }
    }
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($link);
    echo $e->getMessage();
} catch (Exception $e) {
    mysqli_rollback($link);
    echo $e->getMessage();
}

include 'includes/form.php';