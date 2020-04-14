<?php

$config['db_host'] = '127.0.0.1';
$config['db_name'] = 'jsondb';
$config['db_user'] = 'root';
$config['db_pass'] = '1c3t1m3*';

/*
 * This will connect to the database based on the credentials provided
 */
$link = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);




