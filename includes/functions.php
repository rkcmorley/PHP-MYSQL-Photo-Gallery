<?php
function createURL($thumbnailsUrl, $largeImageUrl){
    $getPage = isset($_GET['page']) == 'home';
    return $getPage ? $thumbnailsUrl : $largeImageUrl;
}

