<?php
include("../config/config_jwt.php");
include("controller/token.php");
$endpoint = $_GET["endpoint"];

switch($endpoint){
    case "login":
        $username = $_POST["username"];
        $password = $_POST["password"];
        include("controller/login.php");
        print_r("teste");
        break;
}