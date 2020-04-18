<?php
// This opens up the directories where the image files will go into.
include dirname(dirname(__FILE__)) . '/includes/directories.php';

// The languages.php will activate the language translation for this page.
include 'includes/languages.php';

// This function creates error reports for the database.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// This error handling method will try to check if the upload form has successfully been filled in or not.
try {
    // This will activate if the user clicks on the submit button.
    if (isset($_POST['singlefileupload'])) {

        // This will check if the user submitted a .jpg file. It will automatically turn any uppercase characters into lowercase characters as .jpg is case sensitive.
        // If it fails, it will throw an exception and undo any changes to the database.
        if (strtolower(substr($_FILES['userfile']['name'], -4)) != ".jpg") {
            throw new Exception("Files must end with .jpg!");
        } else if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {

            // If the file type is correct, then it will transfer the image into the correct folder, which is the uploads folder.
            $updir = dirname(dirname(__FILE__)) . '/images/' . 'uploads/';

            // This will get the original name of the file and turn any uppercase characters into lowercase characters.
            $upfilename = strtolower(basename($_FILES['userfile']['name']));

            // This will concatenate the file path and file name and turn it into a new name.
            $newname = $updir . $upfilename;

            // This contains the old name of the file.
            $tmpname = $_FILES['userfile']['tmp_name'];

            // This is the title of the file provided by the user.
            $title = $_POST['title'];

            //This is the description of the file provided by the user.
            $description = $_POST['description'];

            // This is the image property of the file.
            $size = getimagesize($tmpname);

            // This is the width of the image file.
            $width = $size[0];

            // This is the height of the image file.
            $height = $size[1];

            // If the title isn't provided by the user, it will throw an exception and undo any changes to the database.
            if (!isset($title) OR trim($title) == '') {
                throw new Exception("The title is blank! Please fill it in.");
            }
            // If the description isn't provided by the user, it will throw an exception and undo any changes to the database.
            else if (!isset($description) OR trim($description) == '') {
                throw new Exception("The description is blank! Please write something descriptive.");
            }
            // If the image file does not have any width or height, it will throw an exception and undo any changes to the database.
            else if ($width == 0 OR $height == 0) {
                throw new Exception("Unrecognised image format. It appears to be corrupted. Please format it properly then upload it in .jpg.");
            }
            // If the image file has less than 600 pixels in width or height, it will throw an exception and undo any changes to the database.
            else if ($width <= 600 OR $height <= 600) {
                throw new Exception('Image size is too small. It must be greater than 600 pixels in width and height.');
            }
            // If the same image file has been uploaded again, it will throw an exception and undo any changes to the database.
            else if (file_exists($newname)) {
                throw new Exception("File already exists - not uploaded again");
            } else {
                // If the image file is valid, then it will move it to the uploads folder.
                if (move_uploaded_file($tmpname, $newname)) {
                    echo "File uploaded successfully!" . PHP_EOL;
                    // If the image has been successfully validated, it will create a query which contains the title, description, file name, width and height.
                    // This will then be inserted into the database, images.
                    $query = "INSERT INTO images (title, description, file_name, width, height) VALUES ('$title', '$description','$upfilename', '$width', '$height' )";
                    if (mysqli_query($link, $query)) {
                        echo "Well done!";
                    } else {
                        // If it fails, it will throw an exception and undo any changes to the database.
                        throw new Exception("Error: " . $query . "" . mysqli_error($link));
                    }
                } else {
                    // If the file fails to validate successfully, it will throw an exception and undo any changes to the database.
                    throw new Exception("File not uploaded successfully!");
                }
            }
        } else {
            // The error variable will get the file and create the following error messages.
            $error = $_FILES['userfile']['error'];
            // The error occurs if the uploaded file size is too large. It will throw an exception and undo any changes to the database.
            if ($error == UPLOAD_ERR_FORM_SIZE) {
                throw new Exception("File upload failed - form size exceeded");
            }
            // The error occurs if the file is uploaded only half way through. It will throw an exception and undo any changes to the database.
            else if ($error == UPLOAD_ERR_PARTIAL) {
                throw new Exception("File upload failed - partial exceeded");
            }
            // The error occurs if there's no file detected. It will throw an exception and undo any changes to the database.
            else if ($error == UPLOAD_ERR_NO_FILE) {
                throw new Exception("File upload failed - no file supplied");
            }
            // The error occurs the database has been disconnected. It will throw an exception and undo any changes to the database.
            else {
                throw new Exception("File upload failed - error code" . $error);
            }
        }
    }

    //This will catch any exceptions and print out the error message from the database. It will undo any changes to the database via rollback.
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($link);
    echo $e->getMessage();

    //This will catch any exceptions and print out the general error message. It will undo any changes to the database via rollback.
} catch (Exception $e) {
    mysqli_rollback($link);
    echo $e->getMessage();
}

// This will render the contact form.
include 'includes/form.php';