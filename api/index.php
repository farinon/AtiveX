<?php
include("../config/config.php");
include("../config/config_jwt.php");
include("core/token.php");
include("core/permission.php");

$endpoint = $_GET["endpoint"];
$username;
$valid_token = false;
$permissions = "";
$headers = apache_request_headers();
$token = (!empty($headers["Authorization"])) ? str_replace("Bearer ", "", $headers["Authorization"]) : "";

$data = json_decode(file_get_contents("php://input"));
if(!empty($token)){
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
        
        if($valid_token && $permissions->has_permission_to("p_reg_employees")){
            //print_r($permissions);
            include("controller/test.php");
        } else{
            die(json_encode('{"error":"Usuário não autorizado a usar o recurso"}'));
        }
        break;
}
?>
