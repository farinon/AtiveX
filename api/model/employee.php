<?php


class employee{
    function login($username,$password){
        $users = [
            0 => [ "username" => "admin", "password" => "senhafacil", "active" => 1]
        ];
        foreach($users as $k=>$v){
            if($v["username"]==$username and $v["password"] == $password){
                return true;
            }
        }
        return false;    
    }
}