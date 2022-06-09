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
        $sql = "SELECT * FROM `employees` WHERE `id` = $p[id]";
        $ret = query($sql);
        $ret = (!empty($ret))? end($ret) : [];
        return $ret;
    }

    function get_list($p = []){
        $sql = "SELECT * FROM `employees`";
        $ret = query($sql);
        return $ret;
    }

    function insert($p){
        $sql = "INSERT INTO `employees`(`name`,    `email`,    `username`,    `password`,    `employee_role_id`,    `active`) 
                                VALUES ('$p[name]','$p[email]','$p[username]','$p[password]','$p[employee_role_id]',1)";
        $ret = query($sql);
        return $ret;
    }

    function update($p){
        $sql = "UPDATE `employees` 
                    SET `name`='$p[name]',`email`='$p[email]',`username`='$p[username]',`password`='$p[password]',`employee_role_id`='$p[employee_role_id]',`active`=$p[active] 
                    WHERE `id`  = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function delete($p){
        $sql = "DELETE FROM `employees` 
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function count($active = 1){
        $sql = "SELECT COUNT(*) users FROM `employees` ";
        $sql .= ($active==0 || $active ==1) ? "WHERE active = $active" : "";
        $ret = query($sql);
        return end($ret);
    }

    function exists($p){
        $sql = "SELECT id FROM `employees` WHERE `username` = '$p[username]' || `email` = '$p[email]'";
        $ret = query($sql);
        $ret = (empty($ret))? false : true;
        return $ret;
    }

    function change_password($email, $password){
        $sql = "UPDATE `employees` SET `password`='$password' 
                    WHERE `email` = '$email'";
        $ret = query($sql);
        return $ret;
    }



}