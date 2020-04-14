<?php

if (isset($_GET['page']) == 'home' OR isset($_GET['image'])) {
    $page_title = $lang['home_title'];
    $page_heading = $lang['home_heading'];
}

if(isset($_GET['page']) == 'uploads'){
    $page_title = $lang['upload_title'];
    $page_heading = $lang['upload_heading'];
}

$home_link = $lang['home_link'];
$upload_link = $lang['upload_link'];

$header = file_get_contents('templates/header.html');
$header = str_replace('[+home+]', $home_link, $header);
$header = str_replace('[+upload+]', $upload_link, $header);
$header = str_replace('[+page_title+]', $page_title, $header);
$header = str_replace('[+page_heading+]', $page_heading, $header);
echo $header;
