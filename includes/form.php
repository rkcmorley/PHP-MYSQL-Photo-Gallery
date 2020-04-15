<?php
$image_title = $lang['image_title'];
$image_description = $lang['image_description'];
$upload_jpeg = $lang['upload_jpeg'];
$button = $lang['button'];

$content = file_get_contents('templates/form.html');
$content = str_replace('[+image_title+]', $image_title, $content);
$content = str_replace('[+image_description+]', $image_description, $content);
$content = str_replace('[+upload_jpeg+]', $upload_jpeg, $content);
$content = str_replace('[+button+]', $button, $content);
echo $content;
