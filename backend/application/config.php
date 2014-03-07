<?php

date_default_timezone_set('Europe/Brussels');

// config of the database connection
require_once('.db_password.php');

$db_config = array(
    'driver' => 'mysql',
    'username' => $username,
    'password' => $password,
    'schema' => 'test',
    'dsn' => array(
        'host' => 'localhost',
        'dbname' => 'test',
        'port' => '3306',
    )
);