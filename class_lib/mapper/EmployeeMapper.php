<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 12:33 PM
 */

namespace class_lib\mapper;

use \class_lib\domain\DomainObject;
use class_lib\utilities\Date;

abstract class EmployeeMapper extends Mapper{
	function __construct() {
		parent::__construct();
		$this->selectStmt = self::$PDO->prepare("SELECT * FROM employees WHERE employeeId=?");
		$this->selectAllStmt = self::$PDO->prepare("SELECT * FROM employees");
		$this->insertStmt = self::$PDO->prepare("INSERT INTO employees
          (employeeId,firstname,lastname,othernames,gender,date_of_birth,nationality,state_of_origin,
          lga,employment_date,retirement_date,rank)
          VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$this->updateStmt = self::$PDO->prepare("UPDATE employees SET employeeId=?,firstname=?,lastname=?,othernames=?,
			gender=?,date_of_birth=?,nationality=?,state_of_origin=?,lga=?,
			employment_date=?,retirement_date=?,rank=?,biography=? WHERE id=?");
		$this->deleteStmt = self::$PDO->prepare("DELETE FROM employees WHERE id=?");
	}

	protected function doCreateObject( array $array ) {
		$obj_path = $this->targetClass();
		$obj = new $obj_path($array['id']);
		$obj->set_employeeId($array['employeeId']);
		$obj->set_firstname( $array['firstname'] );
		$obj->set_lastname( $array['lastname'] );
		$obj->set_othernames( $array['othernames'] );
		$obj->set_gender( $array['gender'] );
		$dob = explode('-', $array['date_of_birth']);
		$obj->set_dateOfBirth(new Date($dob[1], $dob[2], $dob[0]));
		$obj->set_nationality( $array['nationality'] );
		$obj->set_state_of_origin( $array['state_of_origin'] );
		$obj->set_lga( $array['lga'] );
		$doe = explode('-', $array['employment_date']);
		$obj->set_employment_date(new Date($doe[1], $doe[2], $doe[0]));
		$dor = explode('-', $array['retirement_date']);
		$obj->set_retirement_date(new Date($dor[1], $dor[2], $dor[0]));
		$obj->setRank($array['rank']);
		$obj->setBiography($array['biography']);

		return $obj;
	}

	protected function doInsert( DomainObject $object ) {
		$values = array(
			$object->get_employeeId(),
			$object->get_firstname(),
			$object->get_lastname(),
			$object->get_othernames(),
			$object->get_gender(),
			$object->get_dateOfBirth(),
			$object->get_nationality(),
			$object->get_state_of_origin(),
			$object->get_lga(),
			$object->get_employment_date(),
			$object->get_retirement_date(),
			"assistant_lecturer"//$object->getRank()->getRankID()
		);

		return $values;
	}

	function doUpdate( DomainObject $object ) {
		$values = array(
			$object->get_employeeId(),
			$object->get_firstname(),
			$object->get_lastname(),
			$object->get_othernames(),
			$object->get_gender(),
			$object->get_dateOfBirth(),
			$object->get_nationality(),
			$object->get_state_of_origin(),
			$object->get_lga(),
			$object->get_employment_date()->toStr(),
			$object->get_retirement_date()->toStr(),
			$object->getRank()->getRankID(),
			$object->getBiography(),
			$object->getId()
		);
		return $values;
	}

	function doDelete( DomainObject $object ) {
		$values = array( $object->getId() );
		$this->deleteStmt->execute( $values );
	}

	function selectStmt() {
		return $this->selectStmt;
	}

	function selectAllStmt() {
		return $this->selectAllStmt;
	}

	function insertStmt(){
		return $this->insertStmt;
	}
}