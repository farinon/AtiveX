<?php
include("model/maintence.php");
$model_maintence = new maintence();

function insert($p){
    global $model_maintence;
    $ret = false;
    $ret = $model_maintence->insert($p);    
    die(json_encode($ret));
}

function get($p){
    global $model_maintence;
    $ret = $model_maintence->get($p);
    die(json_encode($ret));
}

function get_list($p){
    global $model_maintence;
    $ret = $model_maintence->get_list($p);
    die(json_encode($ret));
}

function update($p){
    global $model_maintence;
    $ret = $model_maintence->update($p);
    die(json_encode($ret));
}

function delete($p){
    global $model_maintence;
    $ret = $model_maintence->delete($p);
    die(json_encode($ret));
}

function count_maintences(){
    global $model_maintence;
    $ret = $model_maintence->count();
    die(json_encode($ret));
}