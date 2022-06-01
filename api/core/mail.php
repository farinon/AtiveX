<?php
//$recipient, $destino, $subject
function send_mail($recipient, $subject, $content){
    // É necessário indicar que o formato do e-mail é html
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= 'From: AtiveX ativexacademy@gmail.com';
    //$headers .= "Bcc: $EmailPadrao\r\n";

    $send_mail = mail($recipient, $subject, $content, $headers);
    if($send_mail){
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    //echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
    } else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "";
    }
}

function template_reset_password($email){
    $content = "<h2>AtiveX - Redefinição de senha</h2><br>
                <h3>Clique no link abaixo para rerefinir se senha para o email <b>$email</b>.</h3>
                <a src='http://asdasdas/$email'>REDEFINIR</a>";

    return $content;
}
