<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 10:33 PM
 */

namespace class_lib\Command;

use \Exception;
use \class_lib\Exceptions;

class CommandResolver {
    private static $dir = 'class_lib\command';
    static function getCommand( $action='Default' ) {
        if ( preg_match( '/\W/', $action ) ) {
            throw new Exception("illegal characters in action");
        }
        $action = strlen($action) ? $action : "Default";
        $class_name = UCFirst($action)."Command";
        $file = (!empty(self::$dir)) ? self::$dir.DIRECTORY_SEPARATOR."{$class_name}.php" : "{$class_name}.php";
        if ( ! file_exists( $file ) ){
            throw new Exceptions\CommandNotFoundException( "could not find file: '$file'" );
        }
        $class = "class_lib\\command\\{$class_name}";
        if ( ! class_exists( $class ) ){
            throw new Exceptions\CommandNotFoundException( "could not find class: '$class'" );
        }
        $cmd = new $class();
        return $cmd;
    }
}