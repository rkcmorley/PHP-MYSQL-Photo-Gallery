<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
try {
    $link = mysqli_connect(
        $config['db_host'],
        $config['db_user'],
        $config['db_pass'],
        $config['db_name']
    );
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($link);
    echo "MYSQL Exception Raised : " . $e->getMessage();
}




