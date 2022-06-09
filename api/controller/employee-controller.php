<?php
include("model/employee.php");
$model_employee = new employee();

function insert($p){
    global $model_employee;
    $ret = false;
    if(!$model_employee->exists($p)){
        $ret = $model_employee->insert($p);
    } else{
        $ret = ["error" => "username ou e-mail já existem."];
    }
    die(json_encode($ret));
}

function get($p){
    global $model_employee;
    $ret = $model_employee->get($p);
    die(json_encode($ret));
}

function get_list(){
    global $model_employee;
    $ret = $model_employee->get_list();
    die(json_encode($ret));
}

function update($p){
    global $model_employee;
    $ret = $model_employee->update($p);
    die(json_encode($ret));
}

function delete($p){
    global $model_employee;
    $ret = $model_employee->delete($p);
    die(json_encode($ret));
}

function count_users(){
    global $model_employee;
    $ret = $model_employee->count();
    die(json_encode($ret));
}