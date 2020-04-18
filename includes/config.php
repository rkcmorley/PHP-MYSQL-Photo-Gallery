<?php
// This function creates the error reports for the database
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// These are the credentials for the database
$config['db_host'] = '127.0.0.1';
$config['db_name'] = 'jsondb';
$config['db_user'] = 'root';
$config['db_pass'] = '1c3t1m3*';

// This will connect to the database based on the credentials provided
try {
    $link = mysqli_connect(
        $config['db_host'],
        $config['db_user'],
        $config['db_pass'],
        $config['db_name']
    );

// This will catch any errors found and print out the exception message.
// When an error is found, this will cause the database to undo any changes made to the database, thereby reduce the
// chances of corrupting the data.
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($link);
    echo "MYSQL Exception Raised : " . $e->getMessage();
}




