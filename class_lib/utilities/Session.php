<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:23 PM
 */

namespace class_lib\utilities;

use \class_lib\domain;


class Session{
    private static $instance;

    private function __construct(){
        Session::start();
    }

    static function instance(){
        if( ! isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    static function start(){
        session_start();
    }

    function end(){
        session_unset();
    }

    static function sessionExists(){
        $instance = Session::instance();
        if(! is_null($instance->getUser())){
            return true;
        }else{
            return false;
        }
    }

    function setUser(domain\Person $user){
        $_SESSION['user_id'] = $user->get_employeeId();
        return $this->setUserType($user);
    }
    function getUser(){
        return ($user = isset( $_SESSION['user_id']) ? $_SESSION['user_id'] : null);
    }

    private function setUserType(domain\Person $user){
        $_SESSION['user_type'] = get_class($user);
        return $this;
    }
    function getUserType(){
        return ($staff_type = isset( $_SESSION['user_type']) ? $_SESSION['user_type'] : "Guest");
    }

}