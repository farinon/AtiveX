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
            die(error(1));
        }
        break;
    case "permissions":  
        if($valid_token){
           die(json_encode($permissions->get_user_permissions()));
        } else{
            die(error(1));
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
            die(error(1));
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
            die(error(1));
        }
        break;
    case "asset":
        //&& 
        //p_reg_assets p_man_assets p_track_asset  
            if($valid_token){
                $data = json_decode(file_get_contents("php://input"), true);
                include("controller/asset-controller.php");
                switch($verb){
                    case "POST":
                        if($permissions->has_permission_to("p_reg_assets")){
                            insert($data);
                        } else{
                            die(error(1));
                        }
                        
                        break;
                    case "GET":
                        if($permissions->has_permission_to("p_track_asset")){
                            if(empty($data)){
                                get_list();
                            } else{
                                get($data);
                            }
                        } else{
                            die(error(1));
                        }
                        break;
                    case "PATCH":
                        if($permissions->has_permission_to("p_man_assets")){
                            update($data);
                        } else{
                            die(error(1));
                        }
                        break;
                    case "DELETE":
                        if($permissions->has_permission_to("p_man_assets")){
                            delete($data);
                        } else{
                            die(error(1));
                        }

                        break;
                    case "COUNT":
                        count_users();
                        break;
                    }
    
                } else{
                die(error(1));
            }
            break;
            case "ocurrence":  
                if($valid_token && $permissions->has_permission_to("p_man_assets")){
                    $data = json_decode(file_get_contents("php://input"), true);
                    include("controller/ocurrence-controller.php");
                    switch($verb){
                        case "POST":
                            insert($data);
                            break;
                        case "GET":
                            get_list($data);
                            break;
                        case "PATCH":
                            update($data);
                            break;                        
                        }
        
                    } else{
                    die(error(1));
                }
                break;
}

function error($id){
    $errors = [
        1 => "Usuário não autorizado a usar o recurso"
    ];
    return json_encode($errors[$id]);
}
?>
