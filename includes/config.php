<?php
$config['db_host'] = '127.0.0.1';
$config['db_name'] = 'jsondb';
$config['db_user'] = 'root';
$config['db_pass'] = '1c3t1m3*';

/*$config['db_host'] = 'mysqlsrv.dcs.bbk.ac.uk';
$config['db_name'] = 'rmorle01db';
$config['db_user'] = 'rmorle01';
$config['db_pass'] = 'bbkmysql';*/

/*
 * This will connect to the database based on the credentials provided
 */
$link = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

// Attempt create table query execution
$sql = "CREATE TABLE images(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description VARCHAR(255),
    file_name VARCHAR(255) NOT NULL UNIQUE,
    width INT(255),
    height INT(255)
)";
if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} /*else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}*/

