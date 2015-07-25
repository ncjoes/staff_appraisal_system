<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/10/15
 * Time: 1:30 AM
 */

namespace class_lib\mapper\collections;

use \class_lib\domain\DomainObject;
use \class_lib\mapper\Mapper;

//Proposed Improvements
//1. implement Lazy Load Pattern for child classes

abstract class Collection implements \Iterator {
    protected $mapper;
    protected $total = 0;
    protected $raw = array();
    private $pointer = 0;
    private $objects = array();

    function __construct( array $raw=null, Mapper $mapper=null ) {
        if ( ! is_null( $raw ) && ! is_null( $mapper ) ) {
            $this->raw = $raw;
            $this->total = count( $raw );
        }
        $this->mapper = $mapper;
    }

    private function getRow( $num ) {
        $this->notifyAccess();
        if ( $num >= $this->total || $num < 0 ) {
            return null;
        }
        if ( isset( $this->objects[$num]) ) {
            return $this->objects[$num];
        }
        if ( isset( $this->raw[$num] ) ) {
            $this->objects[$num]=$this->mapper->createObject( $this->raw[$num] );
            return $this->objects[$num];
        }
        return null;
    }

    function add(DomainObject $object ) {
        //TODO: track and fix bug
        $class = $this->targetClass();
        if ( ! ($object instanceof $class ) ) {
            throw new \Exception("This is a {$class} collection: attempting to add ".get_class($object));
        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    function remove(DomainObject $object){
        $class = $this->targetClass();
        if ( ! (get_class($object) == $class ) ) {
            throw new \Exception("This is a {$class} collection: attempting to remove ".get_class($object));
        }
        $this->notifyAccess();
        //TODO: remove from raw array and objects array
    }

    public function rewind() {
        $this->pointer = 0;
    }
    public function current() {
        return $this->getRow( $this->pointer );
    }
    public function key() {
        return $this->pointer;
    }
    public function next() {
        $row = $this->getRow( $this->pointer );
        if ( $row ) { $this->pointer++; }
        return $row;
    }
    public function valid() {
        return ( ! is_null( $this->current() ) );
    }
    public function size(){
        return sizeof($this->raw);
    }

    abstract function targetClass();
    protected function notifyAccess() {
        // deliberately left blank!
    }
}