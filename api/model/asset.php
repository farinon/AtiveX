<?php
class asset{
    function get($p){
        $sql = "SELECT * FROM `Assets` WHERE `id` = $p[id]";
        $ret = query($sql);
        $ret = (!empty($ret))? end($ret) : [];
        return $ret;
    }

    function get_list($p = []){
        $sql = "SELECT * FROM `Assets`";
        $ret = query($sql);
        return $ret;
    }

    function insert($p){
        $sql = "INSERT INTO `Assets`(`name`, `description`, `purchase_date`, `purchase_value`, `start_use_date`, `actual_value`, `depreciation_rule`, `employee_id`, `sector_id`, `maintence_interval`) 
                             VALUES ('$p[name]', '$p[description]', '$p[purchase_date]', '$p[purchase_value]', '$p[start_use_date]', $p[actual_value], '$p[depreciation_rule]', $p[employee_id], $p[sector_id], $p[maintence_interval])";
        $ret = query($sql);
        return $ret;
    }

    function update($p){
        $sql = "UPDATE `Assets` 
                    SET `name`              ='$p[name]',
                        `description`       ='$p[description]', 
                        `purchase_date`     = '$p[purchase_date]', 
                        `start_use_date`    = '$p[start_use_date]', 
                        `actual_value`      = $p[actual_value], 
                        `depreciation_rule` = '$p[depreciation_rule]', 
                        `employee_id`       = $p[employee_id], 
                        `sector_id`         = $p[sector_id], 
                        `maintence_interval`= $p[maintence_interval]
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function delete($p){
        $sql = "DELETE FROM `Assets` 
                    WHERE `id` = $p[id]";
        $ret = query($sql);
        return $ret;
    }

    function count(){
        $sql = "SELECT COUNT(*) asset FROM `Assets` ";
        $ret = query($sql);
        return end($ret);
    }

    /* function exists($p){
        $sql = "SELECT id FROM `Assets` WHERE `name` = '$p[name]'";
        $ret = query($sql);
        $ret = (empty($ret))? false : true;
        return $ret;
    } */



}