<?php

class permission{
    private $_user;
    private $_permissions;
    
	function __construct($user){
        $this->_user=$user;
		$this->set_user_permissions($this->_user);

    }

    private function set_user_permissions($user){
        $sql = " select tal coisa from";
                
        // $ret = $this->_c->query('api', $sql);
         
         //print_r($ret);
         return isset($ret) ? $ret : [];
    }

    public function has_permission_to($permission){
        $permissions = $this->_permissions;
        $ret = false;
        
        if(!empty($permission)&& !empty($permissions) &&is_array($permissions)){            
            $ret = $permissions[$permission];
        }
        return $ret;
    }
}