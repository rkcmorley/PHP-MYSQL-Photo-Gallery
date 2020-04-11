<?php

require_once dirname(dirname(__FILE__)) . '/includes/directories.php';
require_once 'includes/table_creation.php';
require_once 'lang/' . $config['language'] . '.php';

$home_link = $lang['home_link'];
$upload_link = $lang['upload_link'];
$page_title = $lang['upload_title'];
$page_heading = $lang['upload_heading'];

$header = file_get_contents('templates/header.html');
$header = str_replace('[+home+]', $home_link, $header);
$header = str_replace('[+upload+]', $upload_link, $header);
$header = str_replace('[+page_title+]', $page_title, $header);
$header = str_replace('[+page_heading+]', $page_heading, $header);
echo $header;

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

        if (mysqli_query($link, $query)) {
            echo "Data Inserted Successully! <br/>";
        } else {
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
<form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'); ?>"
      method="post">
<?php
$image_title = $lang['image_title'];
$image_description = $lang['image_description'];
$upload_jpeg = $lang['upload_jpeg'];
$button = $lang['button'];

$content = file_get_contents('templates/upload_form.html');
$content = str_replace('[+image_title+]', $image_title, $content);
$content = str_replace('[+image_description+]', $image_description, $content);
$content = str_replace('[+upload_jpeg+]', $upload_jpeg, $content);
$content = str_replace('[+button+]', $button, $content);
echo $content;
