<?php
// This contains the value of the action attribute. It will reload on the same page if the form has been submitted.
$self = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

// This contains the value for the title input.
// If the value is filled in, it will keep it. If not, it will stay blank.
$title = isset($_POST['title']) ? htmlentities($_POST['title']) : '';

// This contains the value for the description input.
// If the value is filled in, it will keep it. If not, it will stay blank.
$description = isset($_POST['description']) ? htmlentities($_POST['description']) : '';

// The output creates the upload form. It contains the title, description, file input and the submit button.
// The output also contains the variables for changing the language.
$output = '';
$output .= "<form enctype='multipart/form-data' action='" . htmlentities($self) . "' method='post'>";
$output .= "<div>";
$output .= "<label for='title'>" . $lang['image_title'] . "</label>";
$output .= "<input type='text' name='title' id='title' class='input' value='" . htmlentities($title) . "'/>";
$output .= "</div>";
$output .= "<div>";
$output .= "<label for='description'>" . $lang['image_description'] . "</label>";
$output .= "<input type='text' name='description' id='description' class='input' value='" . htmlentities($description) . "'/>";
$output .= "</div>";
$output .= "<div>";
$output .= "<label for='fileinput'>" . $lang['upload_jpeg'] . "</label>";
$output .= "<input name='userfile' type='file' id='fileinput' class='input' />";
$output .= "</div>";
$output .= "<div>";
$output .= "<input type='submit' class='submitBtn' value =" . $lang['button'] . " name='singlefileupload'/>";
$output .= "</div>";
$output .= "</form>";
echo $output;