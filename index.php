<?php
require_once 'includes/config.php';

if (!isset($_GET['page'])) {
    $page = 'home';
} else {
    $page = $_GET['page'];
}

switch ($page) {
    case 'home' :
        include 'views/home.php';
        break;
    case 'uploads' :
        include 'views/uploads.php';
        break;
    case 'largeimage' :
        include 'views/largeimage.php';
        break;
/*    case 'data' :
        include 'views/data.php';
        break;*/
    default :
        include 'views/404.php';
}

include_once 'templates/footer.html';

