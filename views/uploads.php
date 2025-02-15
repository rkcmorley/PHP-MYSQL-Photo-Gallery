<?php

require_once dirname(dirname(__FILE__)) . '/includes/files.config.php';

require_once 'includes/header.php';
$page_title = "Upload an image file";

if (isset($_POST['singlefileupload'])) {

    // Process the uploaded files here...
    if (substr($_FILES['userfile']['name'], -4) != ".jpg") {
        echo "Files must end with .jpg!";
    } else if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        $updir = dirname(dirname(__FILE__)) . '/uploads/';
        $upfilename = basename($_FILES['userfile']['name']); //original file name
        $newname = $updir . $upfilename; //concatenate file path and file name, the new name
        $tmpname = $_FILES['userfile']['tmp_name']; //old name

        list($width, $height, $type, $attr) = getimagesize($upfilename);

        $size = getimagesize($tmpname);
        $width = $size[0];
        $height = $size[1];

        $title = $_POST['title'];
        $description = $_POST['description'];

        $query = "INSERT INTO images (title, description, file_name, width, height) VALUES ('$title', '$description','$upfilename', '$width', '$height' )";

        if(mysqli_query($link, $query))
        {
            echo "Data Inserted Successully! <br/>";
        }
        else{
            echo "Error: " . $query . "" . mysqli_error($link);
        }

        if (file_exists($newname)) {
            echo "File already exists - not uploaded again";
        } else {
            if (move_uploaded_file($tmpname, $newname)) {
                echo "File uploaded successfully!";
            } else {
                echo "File not uploaded successfully!";
            }
        }
    } else {
        $error = $_FILES['userfile']['error'];
        if ($error == UPLOAD_ERR_FORM_SIZE) {
            echo "File upload failed - form size exceeded";
        } else if ($error == UPLOAD_ERR_PARTIAL) { //failed to upload half way through
            echo "File upload failed - partial exceeded";
        } else if ($error == UPLOAD_ERR_NO_FILE) {
            echo "File upload failed - no file supplied";
        } else {
            echo "File upload failed - error code" . $error;
        }
    }


}
?>

<!-- Make form submit to the current page... NB: always escape REQUEST_URI/PHP_SELF!!! -->
<form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>"
      method="post">
    <div>
        <label for="title">Image title:</label>
        <input type="text" name="title" id="title" />
    </div>
    <div>
        <label for="description">Image description:</label>
        <input type="text" name="description" id="description" />
    </div>
    <div>
        <label for="fileinput">Upload a jpeg file:</label>
        <input name="userfile" type="file" id="fileinput"/>
    </div>
    <div>
        <input type="submit" value="Upload File" name="singlefileupload"/>
    </div>
</form>