<?php


class employee{
    function login($username,$password){
        $sql = "SELECT 1 FROM `employees` WHERE `username` = '$username' AND `password` = '$password' AND `active` = true;";
        $users = query($sql);
       if(!empty($users)){
            return true;
        }
        return false;    
    }

    function get($p){

    }

    function get_list($p){

    }

    function insert($p){

    }

    function update($p){

    }

    function delete($p){
        
    }

    function change_password($email, $password){
        $sql = "UPDATE `employees` SET `password`='$password' WHERE `email` = '$email'";
        $ret = query($sql);
        return $ret;
    }



}