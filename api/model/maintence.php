<?php
class maintences{
    function get($p){
        $sql = "SELECT * FROM `Maintences` WHERE `id` = $p[id]";
        $ret = query($sql);
        $ret = (!empty($ret))? end($ret) : [];
        return $ret;
    }

    function get_list($p = []){
        $sql = "SELECT * FROM `Maintences`";
        $ret = query($sql);
        return $ret;
    }

    function insert($p){
        $sql = "INSERT INTO `Maintences`(`description`, `time_to_complete`, `action_notes`, `status`, `value`) 
                                VALUES ('$p[description]', $p[time_to_complete], '$p[action_notes]', $p[status], $p[value])";
        $ret = query($sql);
        return $ret;
    }

    function update($p){
        $sql = "UPDATE `Maintences` 
                    SET `description`       = '$p[description]',
                        `time_to_complete`  = $p[time_to_complete],
                        `action_notes`      = '$p[action_notes]',
                        `status`            = $p[status],
                        `value`             = $p[value] 
                    WHERE `id`    = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function delete($p){
        $sql = "DELETE FROM `Maintences` 
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function count(){
        $sql = "SELECT COUNT(*) maintences FROM `Maintences` ";
        $ret = query($sql);
        return end($ret);
    }

}