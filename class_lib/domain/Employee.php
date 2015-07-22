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
    private $employee_level;
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

    function setEmployeeLevel($level){
        $this->employee_level = $level;
    }
    function getEmployeeLevel(){
        return $this->employee_level;
    }
    function getRank(){
        return $this->employee_level;
    }
}