<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/16/2015
 * Time: 7:18 PM
 */

namespace class_lib\mapper;
use \class_lib\domain;
use \class_lib\mapper\collections;

class AccessDataMapper extends Mapper {
    function __construct() {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare("SELECT * FROM access_data WHERE user_id = ? ");
        $this->selectAllStmt = self::$PDO->prepare("SELECT * FROM access_data");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO access_data (id, user_id, password, user_type, is_suspended, is_deleted)
              VALUES (NULL , ?, ?, ?, ?, ?);");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE access_data SET user_id=?, password=?, is_suspended=?, is_deleted=? WHERE id=?");
        $this->deleteStmt = self::$PDO->prepare("DELETE FROM access_data WHERE id=?");
    }

    function getCollection( array $raw ) {
        return new collections\StaffCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new domain\AccessData();
        $obj->setId($array['id']);
        $obj->set_username($array['user_id']);
        $obj->set_password($array['password']);
        $obj->setUserType($array['user_type']);

        return $obj;
    }

    protected function doInsert( domain\DomainObject $object ) {
        $values = array( NULL, $object->getUsername(), $object->getPassword(), $object->getUserType(), 0, 0 );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    function doUpdate( domain\DomainObject $object ) {
        $values = array( $object->getUsername(), $object->getPassword(), 0, 0, $object->getId() );
        $this->updateStmt->execute( $values );
    }

    function doDelete( domain\DomainObject $object ) {
        $values = array( $object->getUsername() );
        $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectStmt;
    }

    function targetClass()
    {
        return "class_lib\\domain\\AccessData";
    }
}