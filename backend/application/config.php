<?php

date_default_timezone_set('Europe/Brussels');

// config of the database connection
require_once('../.db_password.php');

$db_config = array(
    'driver' => 'mysql',
    'username' => $username,
    'password' => $password,
    'schema' => 'c7185zrc_isis',
    'dsn' => array(
        'host' => 'localhost',
        'dbname' => 'c7185zrc_isis',
        'port' => '3306',
    )
);