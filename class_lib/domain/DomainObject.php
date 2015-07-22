<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/10/15
 * Time: 1:20 AM
 */

namespace class_lib\domain;


abstract class DomainObject {
    private $id = -1;

    function __construct( $id=null ) {
        if(is_null($id)){
            $this->markNew();
        }else{
            $this->id = $id;
        }
    }
    function setId($id){
        $this->id = $id;
    }
    function getId( ) {
        return $this->id;
    }

    static function getCollection( $type ) {
        return DomainObjectHelper::getCollection($type);
    }
    function collection() {
        return self::getCollection( get_class( $this ) );
    }

    static function getMapper( $class_name ) {
        return DomainObjectHelper::getMapper( $class_name );
    }
    function mapper() {
        return self::getMapper( get_class( $this ) );
    }

    function markClean(){
        DomainObjectWatcher::addClean($this);
    }
    function markNew(){
        DomainObjectWatcher::addNew($this);
    }
    function markDirty(){
        DomainObjectWatcher::addDirty($this);
    }
    function markDelete(){
        DomainObjectWatcher::addDelete($this);
    }
}