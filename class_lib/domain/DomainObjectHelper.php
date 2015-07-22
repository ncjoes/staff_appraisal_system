<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 2:04 PM
 */

namespace class_lib\domain;


use \class_lib\mapper\MapperRegistry;

abstract class DomainObjectHelper {
    static  function getCollection($type){
        $class_name = $type."Collection";
        return new $class_name();
    }

    static  function getMapper($class_name){
        return MapperRegistry::getMapper($class_name);
    }
}