<?php
class ocurrence{
    function get($p){
        $sql = "SELECT * FROM `Ocurrences` WHERE `id` = $p[id]";
        $ret = query($sql);
        $ret = (!empty($ret))? end($ret) : [];
        return $ret;
    }

    function get_list($p = []){
        $sql = "SELECT * FROM `Ocurrences`";
        $ret = query($sql);
        return $ret;
    }

    function insert($p){
        $sql = "INSERT INTO `Ocurrences`(`description`, `action_notes`, `status`, `value`) 
                                VALUES ('$p[description]', NOW(), '$p[action_notes]', $p[status], $p[value])";
        $ret = query($sql);
        return $ret;
    }

    function update($p){
        $sql = "UPDATE `Ocurrences` 
                    SET `description`='$p[description]',`action_notes`='$p[action_notes]',`status`=$p[status], `value`=$p[value] 
                    WHERE `id`  = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function delete($p){
        $sql = "DELETE FROM `Ocurrences` 
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function count(){
        $sql = "SELECT COUNT(*) sector FROM `Ocurrences` ";
        $ret = query($sql);
        return end($ret);
    }

}