<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:29 PM
 */

namespace class_lib\domain;

use class_lib\utilities\Date;

class Qualification extends Credential{
    private $employeeId;
    private $title;
    private $category;
    private $date_obtained;
    private $awarding_institution;
    private static $types = array("B.Sc","M.Sc","PhD");

    function __construct($id=null){
        parent::__construct($id);
    }

    public function getStaffId()
    {
        return $this->employeeId;
    }

    public function setStaffId($employeeId)
    {
        $this->employeeId = $employeeId;
        $this->markDirty();
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->markDirty();
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        $this->markDirty();
        return $this;
    }

    public function getDateObtained()
    {
        return $this->date_obtained;
    }

    public function setDateObtained(Date $date_obtained)
    {
        $this->date_obtained = $date_obtained;
        $this->markDirty();
        return $this;
    }

    public function getAwardingInstitution()
    {
        return $this->awarding_institution;
    }

    public function setAwardingInstitution($awarding_institution)
    {
        $this->awarding_institution = $awarding_institution;
        $this->markDirty();
        return $this;
    }

	public static function getQualificationTypes(){
		return Qualification::$types;
	}
}