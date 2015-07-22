<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 1:05 PM
 */

namespace class_lib\mapper;

//caching mapper objects
class MapperRegistry {
    static private $mapper_objects = array();

    static function getMapper($class_name){
        if(!isset(MapperRegistry::$mapper_objects[$class_name]) or !is_object(MapperRegistry::$mapper_objects[$class_name])){
            $arr = explode('\\', $class_name);
            $root_class_name = $arr[sizeof($arr)-1];
            $mapper_class_name = "class_lib\\mapper\\{$root_class_name}Mapper";
            MapperRegistry::$mapper_objects[$class_name] = new $mapper_class_name();
        }
        return MapperRegistry::$mapper_objects[$class_name];
    }
} 