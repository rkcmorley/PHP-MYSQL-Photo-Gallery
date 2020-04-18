<?php
// This will set the page on the query parameter, by default, it will select uploads.
if (!isset($_GET['page'])) {
    $page = 'home';
} else {
    //Otherwise, it will get the appropriate page.
    $page = $_GET['page'];
}

// This will switch title and header translation depending on the page.
switch ($page) {
    case 'home':
        $page_title = $lang['home_title'];
        $page_heading = $lang['home_heading'];
        break;
    case 'uploads':
        $page_title = $lang['upload_title'];
        $page_heading = $lang['upload_heading'];
        break;
    case 'largeimage':
        $page_title = $lang['home_title'];
        $page_heading = $lang['home_heading'];
        break;
    default :
        $page_title = $lang['error_title'];
        $page_heading = $lang['error_heading'];
}

// These are the home and upload URL.
$home_link = $lang['home_link'];
$upload_link = $lang['upload_link'];

// These will get the HTML content of the header and replace the placeholder
// into the appropriate language or translation.
$header = file_get_contents('templates/header.html');
$header = str_replace('[+home+]', $home_link, $header);
$header = str_replace('[+upload+]', $upload_link, $header);
$header = str_replace('[+page_title+]', $page_title, $header);
$header = str_replace('[+page_heading+]', $page_heading, $header);
echo $header;

