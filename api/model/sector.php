<?php
class sector{

    function get($p){
        $sql = "SELECT * FROM `Sectors` WHERE `id` = $p[id]";
        $ret = query($sql);
        $ret = (!empty($ret))? end($ret) : [];
        return $ret;
    }

    function get_list($p = []){
        $sql = "SELECT * FROM `Sectors`";
        $ret = query($sql);
        return $ret;
    }

    function insert($p){
        $sql = "INSERT INTO `Sectors`(`name`, `description`, `phone`) 
                                VALUES ('$p[name]','$p[description]','$p[phone]')";
        $ret = query($sql);
        return $ret;
    }

    function update($p){
        $sql = "UPDATE `Sectors` 
                    SET `name`='$p[name]',`description`='$p[description]',`phone`='$p[phone]' 
                    WHERE `id`  = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function delete($p){
        $sql = "DELETE FROM `Sectors` 
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function count(){
        $sql = "SELECT COUNT(*) sector FROM `Sectors` ";
        $ret = query($sql);
        return end($ret);
    }

    function exists($p){
        $sql = "SELECT id FROM `Sectors` WHERE `name` = '$p[name]'";
        $ret = query($sql);
        $ret = (empty($ret))? false : true;
        return $ret;
    }

}