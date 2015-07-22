<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 10:45 PM
 */

namespace class_lib\utilities;

use \class_lib\domain;

//handles all aspects of authentication and authorization
class AccessManager {
    private static $instance;
    private $error;
    private function __construct(){}

    static function instance(){
        if( ! isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    function login($username, $password){
        $accessDataMapper = domain\AccessData::getMapper("AccessData");
        $accessDataObj = $accessDataMapper->find($username);
        if(is_null($accessDataObj)){
            $this->error = "user $username does not exist";
            return null;
        }
        if($accessDataObj->getPassword() != $password){
            $this->error = "invalid username/password pair";
            return null;
        }
        $user_type = "class_lib\\domain\\{$accessDataObj->getUserType()}";
        //$user_obj = new $user_type();
        $mapper = $user_type::getMapper($accessDataObj->getUserType());
        $user_obj = $mapper->find($username);

        return $user_obj;
    }

    function getError(){
        return $this->error;
    }
} 