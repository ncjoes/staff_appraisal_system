<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 11:40 PM
 */

namespace class_lib\domain;


class DomainObjectWatcher {
    private $all = array();
    private $dirty = array();
    private $new = array();
    private $delete = array();
    private static $instance;

    private function __construct() { }
    static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new DomainObjectWatcher();
        }
        return self::$instance;
    }

    function globalKey( DomainObject $obj ) {
        $key = get_class( $obj ).".".$obj->getId();
        return $key;
    }

    static function add( DomainObject $obj ) {
        $inst = self::instance();
        $inst->all[$inst->globalKey( $obj )] = $obj;
    }
    static function exists( $class_name, $id ) {
        $inst = self::instance();
        $key = "$class_name.$id";
        if ( isset( $inst->all[$key] ) ) {
            return $inst->all[$key];
        }
        return null;
    }

    static function addDelete( DomainObject $obj ) {
        $self = self::instance();
        $self->delete[$self->globalKey( $obj )] = $obj;
    }

    static function addDirty( DomainObject $obj ) {
        $inst = self::instance();
        if ( ! in_array( $obj, $inst->new, true ) ) {
            $inst->dirty[$inst->globalKey( $obj )] = $obj;
        }
    }

    static function addNew( DomainObject $obj ) {
        $inst = self::instance();
        // we don't yet have an id
        $inst->new[] = $obj;
    }

    static function addClean( DomainObject $obj ) {
        $self = self::instance();
        unset( $self->delete[$self->globalKey( $obj )] );
        unset( $self->dirty[$self->globalKey( $obj )] );
        $self->new = array_filter( $self->new, function( $a ) use ( $obj ) { return !( $a === $obj ); });
    }

    function performOperations() {
        //START TRANSACTION
        foreach ( $this->delete as $key=>$obj ) {
            $obj->mapper()->del( $obj );
            unset($this->all[$key]);
        }
        foreach ( $this->dirty as $key=>$obj ) {
            $obj->mapper()->update( $obj );
        }
        foreach ( $this->new as $key=>$obj ) {
            $obj->mapper()->insert( $obj );
        }
        $this->dirty = array();
        $this->new = array();
        //END TRANSACTION
    }
}