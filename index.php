<?php

// This will load the database configuration.
include 'includes/config.php';

// This will start the session.
session_start();

// This will check if the session, language, has been set. If it does it will look into lang folder.
// Once it's confirmed, the session will take the language it's currently selected to.
if(isset($_POST['language']) && file_exists("lang/". $_POST['language'] . ".php")){
    $_SESSION['language'] = "lang/". $_POST['language'] . ".php";
}

// This will check if the language has been selected. If it is, then it will display the appropriate language.
// Otherwise, it will select English as the default language.
isset($_SESSION['language']) ? include($_SESSION['language']) : include("lang/en.php");

// If the page has not been set, it will select home.
if (!isset($_GET['page'])) {
    $page = 'home';
} else {
    //Otherwise, it will get the appropriate page.
    $page = $_GET['page'];
}

// This will switch pages depending on the $_GET query parameter.
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

// This will display the footer.
include_once 'templates/footer.html';

