<?php

function base_64_url_encode($data){
    return str_replace(['+','/','='],['-','_',''],base64_encode($data));
}


function get_token(){
    global $secret;
    $header = base_64_url_encode('{"alg": "HS256", "typ": "JWT"}');
    $payload = base_64_url_encode('{"sub": "'.md5(time()).'", "name": "'.$secret.'", "iat": "'.time().'"}');
    $signature = base_64_url_encode(hash_hmac('sha256', $header.'.'.$payload,'segredo', true));

    return $header.'.'.$payload.'.'.$signature;
}

function verify_token($token){
    $parts = explode('.', $token);
    $signature =  base_64_url_encode(hash_hmac('sha256', $parts[0].'.'.$parts[1],'segredo', true));

    if($signature == $parts[2]){
        global $secret;
        $payload = json_decode( base64_decode($parts[1]));
        if($payload->name==$secret){
            return true;
        }        
    }
    return false;
}

//print_r(get_token());

//print_r(verify_token("eyJhbGciOiAiSFMyNTYiLCAidHlwIjogIkpXVCJ9.eyJzdWIiOiAiNWMyMmUzNTczMjVmZTVjNjQwZjBiNjAzMGMzZjczZjUiLCAibmFtZSI6ICJBdGl2ZVggRm9yZXZlciIsICJpYXQiOiAiMTY1MzUwNTM3MyJ9.-L7lavby30AMZ-T_lr3oUGvuCM_J5RawsTQC4HYN2Fo"));