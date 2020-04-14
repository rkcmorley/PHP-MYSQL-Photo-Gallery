<?php
/*
 * This will open the connection of the database. If it failed to connect, it will exit and give an error message.
 *
 * If it's successful then it will select the tables and render the data.
 */
if (mysqli_connect_errno()) {
    exit(mysqli_connect_error());
} else {
    $table = $_GET['page'];
    $table_escaped = mysqli_real_escape_string($link, $table);
    $sql = "SELECT * FROM images" . $table_escaped;
}

