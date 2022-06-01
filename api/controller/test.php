<?php

function test($username){
    die(json_encode(["text" => "Usuário $username tem permissão de acessar essa tela."]));
}

