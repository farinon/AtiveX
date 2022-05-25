<?php
include("../config/config_jwt.php");
include("controller/token.php");
$endpoint = $_GET["endpoint"];

switch($endpoint){
    case "login":
        $username = "admin";
        $password = "senhafaci";
        include("controller/login.php");
        print_r("teste");
        break;
}