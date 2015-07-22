<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:28 PM
 */

namespace class_lib\domain;


class AccessData extends DomainObject{
    private $username;
    private $password;
    private $user_type;
    private $is_suspended;
    private $is_deleted;

    function __construct($id=null){
        parent::__construct($id);
    }

    public function set_username($userID){
        $this->username = $userID;
        $this->markDirty();
        return $this;
    }
    public function getUsername(){
        return $this->username;
    }

    public function set_password($password){
        $this->password = $password;
        $this->markDirty();
        return $this;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setUserType($user_type){
        $this->user_type = $user_type;
        $this->markDirty();
        return $this;
    }
    public function getUserType(){
        return $this->user_type;
    }
}