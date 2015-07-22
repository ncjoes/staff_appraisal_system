<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 9:28 AM
 */

/**
 * @param $class //full class name e.g class_lib\domain\Employee
 */
function __autoload( $class ) {
    if ( preg_match( '/\\\\/', $class ) ) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class );
        $path .= ".php";
    }
    if(!is_file($path)){
        echo $path." not found" ;
        exit;
    }
    require_once($path);
}

function autoRun(){
    class_lib\Controller\FrontController::run();
}

