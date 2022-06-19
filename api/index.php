<?php
include("../config/config.php");
include("../config/config_jwt.php");
include("core/mail.php");
include("core/token.php");
include("core/permission.php");

$endpoint = $_GET["endpoint"];
$username;
$valid_token = false;
$permissions = "";
$headers = apache_request_headers();
$token = (!empty($headers["Authorization"])) ? str_replace("Bearer ", "", $headers["Authorization"]) : "";
$verb = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input"));
if(!empty($token)){
    $username = verify_token($token);
    
    if(!empty($username)){
        $valid_token = true;
        $permissions = new permission($username);
    }
}

switch($endpoint){
    case "login":        
        $username = $data->username;
        $password = $data->password;
        include("controller/login-controller.php");
        die(login($username,$password));
        break;
    case "password-recovery":
        $data = json_decode(file_get_contents("php://input"), true);
        $email    = $data->email;
        include("controller/login-controller.php");
        //send_mail();
        reset_login($email,$password);
        break;
    case "test":  
        if($valid_token && $permissions->has_permission_to("p_reg_employees")){
            //print_r($permissions);
            include("controller/test-controller.php");
            test($username);
        } else{
            die(json_encode(["error"=>"Usuário não autorizado a usar o recurso"]));
        }
        break;
    case "permissions":  
        if($valid_token){
           die(json_encode($permissions->get_user_permissions()));
        } else{
            die(json_encode(["error"=>"Usuário não autorizado a usar o recurso"]));
        }
        break;
    case "employee":  
        if($valid_token && $permissions->has_permission_to("p_reg_employees")){
            $data = json_decode(file_get_contents("php://input"), true);
            include("controller/employee-controller.php");
            switch($verb){
                case "POST":
                    insert($data);
                    break;
                case "GET":
                    if(empty($data)){
                        get_list();
                    } else{
                        get($data);
                    }
                    break;
                case "PATCH":
                    update($data);
                    break;
                case "DELETE":
                    delete($data);
                    break;
                case "COUNT":
                    count_users();
                    break;
                }

            } else{
            die(json_encode(["error"=>"Usuário não autorizado a usar o recurso"]));
        }
        break;
    case "sector":  
        if($valid_token && $permissions->has_permission_to("p_reg_sectors")){
            $data = json_decode(file_get_contents("php://input"), true);
            include("controller/sector-controller.php");
            switch($verb){
                case "POST":
                    insert($data);
                    break;
                case "GET":
                    if(empty($data)){
                        get_list();
                    } else{
                        get($data);
                    }
                    break;
                case "PATCH":
                    update($data);
                    break;
                case "DELETE":
                    delete($data);
                    break;
                case "COUNT":
                    count_sectors();
                    break;
                }

            } else{
            die(json_encode(["error"=>"Usuário não autorizado a usar o recurso"]));
        }
        break;
    case "asset":
        //&& $permissions->has_permission_to("p_reg_sectors")  
            if($valid_token){
                $data = json_decode(file_get_contents("php://input"), true);
                include("controller/asset-controller.php");
                switch($verb){
                    case "POST":
                        insert($data);
                        break;
                    case "GET":
                        if(empty($data)){
                            get_list();
                        } else{
                            get($data);
                        }
                        break;
                    case "PATCH":
                        update($data);
                        break;
                    case "DELETE":
                        delete($data);
                        break;
                    case "COUNT":
                        count_users();
                        break;
                    }
    
                } else{
                die(json_encode(["error"=>"Usuário não autorizado a usar o recurso"]));
            }
            break;
}
?>
