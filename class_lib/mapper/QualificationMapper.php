<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 10:46 PM
 */

namespace class_lib\mapper;

use \class_lib\domain;
use \class_lib\mapper\collections\QualificationCollection;
use \class_lib\utilities\Date;

class QualificationMapper extends Mapper{
    function __construct() {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM qualifications WHERE id=?");
        $this->selectByOwnerStmt = self::$PDO->prepare(
            "SELECT * FROM qualifications WHERE employeeId=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE qualifications set title=?, category=?, date_obtained=?, awarding_body=?,status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO qualifications (employeeId,title,category,date_obtained,awarding_body,status)VALUES(?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM qualifications WHERE id=?");
        $this->selectByStatusStmt = self::$PDO->prepare(
            "SELECT * FROM qualifications WHERE status=?");
    }

    function findByStatus($status) {
        $this->selectByStatusStmt->execute( array($status) );
        $raw_data = $this->selectByStatusStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    function findByOwner($employeeId) {
        $this->selectByOwnerStmt->execute( array($employeeId) );
        $raw_data = $this->selectByOwnerStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    function getCollection( array $raw ) {
        return new QualificationCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new domain\Qualification($array['id']);
        $obj->setStaffId($array['employeeId']);
        $obj->setTitle($array['title']);
        $obj->setAwardingInstitution($array['awarding_body']);
        $obj->setCategory($array['category']);
        $date = explode('-', $array['date_obtained']);
        $obj->setDateObtained(new Date($date[1], $date[2], $date[0]));
        $obj->setStatus($array['status']);

        return $obj;
    }

    protected function doInsert( domain\DomainObject $object ) {
        $values = array(
	        $object->getStaffId(),
	        $object->getTitle(),
	        $object->getCategory(),
	        $object->getDateObtained()->toStr(),
	        $object->getAwardingInstitution(),
            $object->getStatus()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    function doUpdate( domain\DomainObject $object ) {
        $values = array(
            $object->getTitle(),
            $object->getCategory(),
            $object->getDateObtained()->toStr(),
			$object->getAwardingInstitution(),
            $object->getStatus(),
            $object->getId()
        );
        $this->updateStmt->execute( $values );
    }

    function doDelete( domain\DomainObject $object ) {
        $values = array( $object->getId() );
        $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectStmt;
    }

    function targetClass(){
        return "class_lib\\domain\\Qualification";
    }
}