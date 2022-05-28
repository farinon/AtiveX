<?php
include("model/employee.php");

$model_employee = new employee();
if($model_employee->login($username,$password)){    
    $ret["token"] = get_token($username);    
} else{
    header("HTTP/1.1 401 Unauthorized");
    $ret["error"] = "Usuário e senha incorreto ou inativo";
}

die(json_encode($ret));
