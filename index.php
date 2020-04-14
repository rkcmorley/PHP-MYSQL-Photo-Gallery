<?php
include 'includes/config.php';


session_start();

if(isset($_POST['language']) && file_exists("lang/". $_POST['language'] . ".php")){
    $_SESSION['language'] = "lang/". $_POST['language'] . ".php";
}
isset($_SESSION['language']) ? include($_SESSION['language']) : include("lang/en.php");

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
    default :
        include 'views/404.php';
}

include_once 'templates/footer.html';

