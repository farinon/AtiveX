<?php
include("model/employee.php");
function login($username,$password){
    $model_employee = new employee();
    if($model_employee->login($username,$password)){    
        $ret["token"] = get_token($username);    
    } else{
        header("HTTP/1.1 401 Unauthorized");
        $ret["error"] = "Usuário e senha incorreto ou inativo";
    }
    return json_encode($ret);
}

function reset_login($email,$password){
    $model_employee = new employee();
    $model_employee->change_password($email,$password);
}

