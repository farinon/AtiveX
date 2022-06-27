<?php
include("model/ocurrence.php");
$model_ocurrence = new ocurrence();

function insert($p){
    global $model_ocurrence;
    $ret = false;
    $ret = $model_ocurrence->insert($p);    
    die(json_encode($ret));
}

function get($p){
    global $model_ocurrence;
    $ret = $model_ocurrence->get($p);
    die(json_encode($ret));
}

function get_list($p){
    global $model_ocurrence;
    $ret = $model_ocurrence->get_list($p);
    die(json_encode($ret));
}

function update($p){
    global $model_ocurrence;
    $ret = $model_ocurrence->update($p);
    die(json_encode($ret));
}

function delete($p){
    global $model_ocurrence;
    $ret = $model_ocurrence->delete($p);
    die(json_encode($ret));
}

function count_ocurrences(){
    global $model_ocurrence;
    $ret = $model_ocurrence->count();
    die(json_encode($ret));
}