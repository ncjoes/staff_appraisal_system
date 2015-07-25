<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:17 PM
 */

namespace class_lib\domain;

use \class_lib\mapper\collections\QualificationCollection;
use \class_lib\mapper\MapperRegistry;
use \class_lib\utilities;

abstract class Employee extends Person{
    private $employeeId;
    private $access_data;
    private $employment_date;
    private $retirement_date;
    private $rank;
    private $qualifications;

    function __construct($id){
        parent::__construct($id);
    }

    function get_employeeId(){
        return $this->employeeId;
    }
    function set_employeeId($id){
        $this->employeeId = $id;
    }

    function set_access_data(AccessData $accessData){
        $this->access_data = $accessData;
    }
    function get_access_data(){
        return $this->access_data;
    }

    function set_employment_date(utilities\Date $date){
        $this->employment_date = $date;
        $this->markDirty();
    }
    function get_employment_date(){
        return $this->employment_date;
    }

    function set_retirement_date(utilities\Date $date){
        $this->retirement_date = $date;
        $this->markDirty();
    }
    function get_retirement_date(){
        return $this->retirement_date;
    }

	function getYearsOfService(){
		$currentDateObj = new utilities\Date();
		$currentDate = $currentDateObj->get_date_int();
		$employmentDate = $this->get_employment_date()->get_date_int();
		$timeOfService = $currentDate - $employmentDate;
		$yearsOfService = (int)( $timeOfService / (60*60*24*365) );

		return $yearsOfService;
	}

    function set_qualifications(QualificationCollection $qualifications){
        foreach($qualifications as $qualification){
            $qualification->setStaffId($this->employeeId);
        }
        $this->qualifications = $qualifications;
    }

    function get_qualifications(){
        if(!isset($this->qualifications)){
            $mapper = MapperRegistry::getMapper("Qualification");
            $this->qualifications = $mapper->findByOwner($this->get_employeeId());
        }
        return $this->qualifications;
    }

    function add_qualification(Qualification $qualification){
        $qualification->setStaffId($this);
	    $this->get_qualifications()->add($qualification);
    }

    function remove_qualification(Qualification $qualification){
        $this->get_qualifications()->remove($qualification);
        $qualification->markDelete();
    }

    function hasQualification($qualificationCategory){
		foreach($this->get_qualifications() as $qualification){
			if($qualification->isApproved() and $qualification->getCategory() == $qualificationCategory){
				return true;
			}
		}
	    return false;
    }

	function getNumOfApprovedQualifications(){
		$num = 0;
		foreach($this->get_qualifications() as $qualification){
			$num = $qualification->isApproved() ? $num+1 : $num+0;
		}
		return $num;
	}

	function setRank($rank){
        $this->rank = $rank;
	    $this->markDirty();
	    return $this;
    }
    function getRank(){
        if(!is_object($this->rank)){
            $mapper = MapperRegistry::getMapper(get_class($this)."Rank");
            $this->rank = $mapper->findByRankID( $this->rank );
        }
        return $this->rank;
    }
}