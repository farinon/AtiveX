<?php
include("model/sector.php");
$model_sector = new sector();

function insert($p){
    global $model_sector;
    $ret = false;
    if(!$model_sector->exists($p)){
        $ret = $model_sector->insert($p);
    } else{
        $ret = ["error" => "Setor já existe."];
    }
    die(json_encode($ret));
}

function get($p){
    global $model_sector;
    $ret = $model_sector->get($p);
    die(json_encode($ret));
}

function get_list(){
    global $model_sector;
    $ret = $model_sector->get_list();
    die(json_encode($ret));
}

function update($p){
    global $model_sector;
    $ret = $model_sector->update($p);
    die(json_encode($ret));
}

function delete($p){
    global $model_sector;
    $ret = $model_sector->delete($p);
    die(json_encode($ret));
}

function count_users(){
    global $model_sector;
    $ret = $model_sector->count();
    die(json_encode($ret));
}