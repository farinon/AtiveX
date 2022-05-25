<?php

$config['menu'] = [
    "import"    => "Importar Registros",
    "students"  => "Alunos",
    "teachers"  => "Professores"
];
$page = "";
if(!empty($_GET['page'])){
    $page = $_GET['page'];
    $config['title'] = "# Cadastros das Universidade # ". $config['menu'][$page]. " # by Tiago da Costa Farinon - 5220208 #" ;
}
$_sep = DIRECTORY_SEPARATOR;
$base  = str_replace('config', '', dirname(__FILE__));
$config['path'] = [
    "uploads"   => $base."uploads".$_sep,
    "helpers"   => $base."api".$_sep."includes".$_sep."helpers".$_sep
];

$config['db'] = [
    "host"      => "localhost",
    "name"      => "ativex", 
    "username"  => "root",
    "password"  => ""
];

$db = new PDO("mysql:host=".$config['db']['host'].";dbname=".$config['db']['name'], $config['db']['username'],$config['db']['password']);

include_once($config['path']["helpers"]."query.php");