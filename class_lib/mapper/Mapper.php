<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 11:53 AM
 */

namespace class_lib\mapper;

use \class_lib\domain;
use \class_lib\utilities;

abstract class Mapper {
    protected static $PDO;

    function __construct() {
        if ( ! isset(self::$PDO) ) {
            $dsn = utilities\ApplicationRegistry::getDSN();
            $user = utilities\ApplicationRegistry::getDbUser();
            $password = utilities\ApplicationRegistry::getDbUserPassword();

            if ( is_null( $dsn ) ) {
                throw new \Exception( "No DSN" );
            }
            self::$PDO = new \PDO($dsn, $user, $password);
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    function find( $id ) {
        $old = $this->getFromMap( $id );
        if ( $old ) { return $old; }
        //do db stuff
        $this->selectStmt()->execute( array( $id ) );
        $array = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        return $object;
    }

    function findAll( ) {
        $this->selectAllStmt()->execute( array() );
        return $this->getCollection($this->selectAllStmt()->fetchAll( \PDO::FETCH_ASSOC ) );
    }

    function createObject( $array ) {
        $old = $this->getFromMap( $array['id']);
        if ( is_object($old) ) { return $old; }
        //construct object
        $obj = $this->doCreateObject( $array );
        //keep record of object
        $this->addToMap($obj);
        $obj->markClean();

        return $obj;
    }

    function insert(domain\DomainObject $domainObject) {
        $this->doInsert( $domainObject );
        $this->addToMap( $domainObject );
    }

    function update(domain\DomainObject $domainObject) {
        $this->doUpdate( $domainObject );
        $domainObject->markClean();
    }

    function del(domain\DomainObject $domainObject) {
        $this->doDelete( $domainObject );
        $domainObject->markClean();
    }

    protected function getFromMap( $id ) {
        return domain\DomainObjectWatcher::exists( $this->targetClass(), $id );
    }

    protected function addToMap( domain\DomainObject $obj ) {
        domain\DomainObjectWatcher::add( $obj );
    }

    abstract function getCollection( array $raw );
    protected abstract function targetClass();
    protected abstract function doCreateObject( array $array );
    protected abstract function doInsert( domain\DomainObject $object );
    protected abstract function doUpdate( domain\DomainObject $object );
    protected abstract function doDelete( domain\DomainObject $object );
    protected abstract function selectStmt();
    protected abstract function selectAllStmt();
}
