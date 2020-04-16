<?php
$self = htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
$title = isset($_POST['title']) ? htmlentities($_POST['title']) : '';
$description = isset($_POST['description']) ? htmlentities($_POST['description']) : '';
$output = '';
$output .= "<form enctype='multipart/form-data' action='" . $self . "' method='post'>";
$output .= "<div>";
$output .= "<label for='title'>" . $lang['image_title'] . "</label>";
$output .= "<input type='text' name='title' id='title' class='input' value='" . $title . "'/>";
$output .= "</div>";
$output .= "<div>";
$output .= "<label for='description'>" . $lang['image_description'] . "</label>";
$output .= "<input type='text' name='description' id='description' class='input' value='" . $description . "'/>";
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