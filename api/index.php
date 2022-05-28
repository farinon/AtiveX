<?php
include("../config/config_jwt.php");
include("core/token.php");
include("core/permission.php");

$endpoint = $_GET["endpoint"];
$username;
$valid_token = false;
$permissions = "";

$data = json_decode(file_get_contents("php://input"));
if(!empty($data->token)){
    $username = verify_token($token);
    if(!empty($username)){
        $valid_token = true;
        $permissions = new permission($username);
    }
}

switch($endpoint){
    case "login":        
        $username = $data->username;
        $password = $data->password;
        include("controller/login.php");
        break;
    case "test":
        if(!empty($permissions) && $permissions->has_permission_to($endpoint)){
            include("controller/test.php");
        } else{
            die(json_encode('{"error":"Usuário não autorizado a usar o recurso"}'));
        }
        break;
}