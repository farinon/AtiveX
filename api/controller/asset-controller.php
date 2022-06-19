<?php
include("model/asset.php");
include("model/maintence.php");
include("model/ocurrence.php");
$model_asset = new asset();

function insert($p){
    global $model_asset;
    $ret = false;
    $ret = $model_asset->insert($p);    
    die(json_encode($ret));
}

function get($p){
    global $model_asset;
    $ret = $model_asset->get($p);
    die(json_encode($ret));
}

function get_list(){
    global $model_asset;
    $ret = $model_asset->get_list();
    die(json_encode($ret));
}

function update($p){
    global $model_asset;
    $ret = $model_asset->update($p);
    die(json_encode($ret));
}

function delete($p){
    global $model_asset;
    $ret = $model_asset->delete($p);
    die(json_encode($ret));
}

function count_assets(){
    global $model_asset;
    $ret = $model_asset->count();
    die(json_encode($ret));
}