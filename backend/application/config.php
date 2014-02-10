<?php

date_default_timezone_set('Europe/Brussels');

// config of the database connection
require_once('../../.db_password.php');

$db_config = array(
    'driver' => 'pgsql',
    'username' => $username,
    'password' => $password,
    'schema' => 'pr537398', // change this
    'dsn' => array(
        'host' => 'localhost',
       // "host"=>"gegevensbanken.khleuven.be",
        'dbname' => '2TX35', // and change this too
        'port' => '51213',
    )
);
