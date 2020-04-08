<?php
/*
 * This will get the necessary file, header.html, and replace the
 * page title and page header two with the content written in each page.
 */
$content = file_get_contents('templates/header.html');
$content = str_replace('[+page_title+]', $page_title, $content);
$content = str_replace('[+page_headerOne+]', $page_headerOne, $content);
echo $content;