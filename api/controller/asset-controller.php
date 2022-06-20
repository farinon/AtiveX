<?php
include("model/asset.php");
include("model/maintence.php");
include("model/ocurrence.php");


function insert($p){
    $model_asset = new asset();
    $ret = false;
    $ret = $model_asset->insert($p);
    
    if(!empty($ret)){
        
        add_ocurrence([ "description"   => "Controle de ativo iniciado.",
                        "action_notes"  => "", 
                        "status"        => 0,
                        "value"         => 0, 
                        "asset_id"     => $ret ]);
        if(!empty($p['start_use_date']) && !empty($p['maintence_interval'])){
            add_maintence([ "description"       => "Primeira manutenção preventiva.",
                            "date_time"         => "ADDDATE('$p[start_use_date]', INTERVAL $p[maintence_interval] DAY)", 
                            "time_to_complete"  => $p["standard_maintence_time"], 
                            "action_notes"      => "", 
                            "status"            => 0, 
                            "value"             => 0, 
                            "asset_id"         => $ret ]);
        }
    }
        
    die(json_encode($ret));
}

function get($p){
    $model_asset = new asset();
    $ret = $model_asset->get($p);
    die(json_encode($ret));
}

function get_list(){
    $model_asset = new asset();
    $ret = $model_asset->get_list();
    die(json_encode($ret));
}

function update($p){
    $model_asset = new asset();
    $ret = $model_asset->update($p);
    die(json_encode($ret));
}

function delete($p){
    $model_asset = new asset();
    $ret = $model_asset->delete($p);
    die(json_encode($ret));
}

function count_assets(){
    $model_asset = new asset();
    $ret = $model_asset->count();
    die(json_encode($ret));
}

function add_ocurrence($p){
    $model_ocurrence = new ocurrence();
    $ret = $model_ocurrence->insert($p);
    return (json_encode($ret));
}

function add_maintence($p){
    $model_maintence = new maintence();
    $ret = $model_maintence->insert($p);
    return (json_encode($ret));
}