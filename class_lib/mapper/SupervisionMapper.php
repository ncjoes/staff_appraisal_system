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

class SupervisionMapper extends Mapper{
    function __construct() {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM supervisions WHERE id=?");
        $this->selectBySupervisorStmt = self::$PDO->prepare(
            "SELECT * FROM supervisions WHERE supervisor=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE supervisions set project=?,supervisor=?,year=?,status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO supervisions ( project,supervisor,year,status ) VALUES ( ?,?,?,? )");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM supervisions WHERE id=?");
	    $this->selectByStatusStmt = self::$PDO->prepare(
		    "SELECT * FROM supervisions WHERE status=?");
    }

	function findByStatus($status) {
		$this->selectByStatusStmt->execute( array($status) );
		$raw_data = $this->selectByStatusStmt->fetchAll(\PDO::FETCH_ASSOC);
		return $this->getCollection( $raw_data );
	}

	function findBySupervisor($employeeId) {
        $this->selectBySupervisorStmt->execute( array($employeeId) );
        $raw_data = $this->selectBySupervisorStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    function getCollection( array $raw ) {
        return new QualificationCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ){
        $obj = new domain\Supervision($array['id']);
        $obj->setProject($array['project']);
        $obj->setSupervisor($array['supervisor']);
        $obj->setYear($array['year']);
	    $obj->setStatus($array['status']);

        return $obj;
    }

    protected function doInsert( domain\DomainObject $object ) {
        $values = array(
            $object->getProject(),
            $object->getSupervisor(),
            $object->getYear(),
	        $object->getStatus()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    function doUpdate( domain\DomainObject $object ) {
        $values = array(
            $object->getProject(),
            $object->getSupervisor(),
            $object->getYear(),
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
        return "class_lib\\domain\\Supervision";
    }
}