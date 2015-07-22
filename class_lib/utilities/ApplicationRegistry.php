<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 12:07 PM
 */

namespace class_lib\utilities;


class ApplicationRegistry {
    static private $instance;
    static private $dsn = "mysql:dbname=staff_portal;host=127.0.0.1";
    static private $db_user = "root";
    static private $db_user_password = "";

    private function __construct(){}

    static function instance(){
        if(!isset(ApplicationRegistry::$instance)){
            ApplicationRegistry::$instance = new ApplicationRegistry();
        }
        return ApplicationRegistry::$instance;
    }

    static function getDSN(){
        return ApplicationRegistry::$dsn;
    }

    static function getDbUser(){
        return ApplicationRegistry::$db_user;
    }

    static function getDbUserPassword(){
        return ApplicationRegistry::$db_user_password;
    }
} 