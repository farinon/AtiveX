<?php

$_sep = DIRECTORY_SEPARATOR;
$base  = str_replace('config', '', dirname(__FILE__));

$config['path'] = [
    "uploads"   => $base."uploads".$_sep,
    "helpers"   => $base."api".$_sep."includes".$_sep."helpers".$_sep
];

$base_url = "http://$_SERVER[HTTP_HOST]";
$config['url'] = [
    "password_recovery"   => $base_url."/?endpoint=password-recovery"
];

$config['db'] = [
    "host"      => "db",
    "name"      => "ativex", 
    "username"  => "root",
    "password"  => "root"
];

$db = new PDO("mysql:host=".$config['db']['host'].";dbname=".$config['db']['name'], $config['db']['username'],$config['db']['password']);

include_once($config['path']["helpers"]."query.php");