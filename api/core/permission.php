<?php

class permission{
    private $_user;
    private $_permissions;
    
	function __construct($user){
        $this->_user=$user;
		$this->set_user_permissions($this->_user);

    }

    private function set_user_permissions($user){        
        $sql = "SELECT b.* FROM `employees` a INNER JOIN `employees_roles` b ON (a.`employee_role_id` = b.`id`) WHERE a.`username` = '$user';";
                
        $ret = query($sql);

         //print_r($ret);
         return !empty($ret) ? end($ret) : [];
    }

    public function has_permission_to($permission){        
        $permissions = $this->_permissions;
        $ret = false;
        
        if(!empty($permission)&& !empty($permissions) && !empty($permissions[$permission])){            
            $ret = $permissions[$permission];
        }
        return $ret;
    }
}