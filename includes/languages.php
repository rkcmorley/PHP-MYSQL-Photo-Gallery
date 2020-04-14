git<?php
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