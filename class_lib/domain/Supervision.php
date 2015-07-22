<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:32 PM
 */

namespace class_lib\domain;


class Supervision extends Credential{
    private $supervisor;
    private $project;
    private $year;

	function __construct($id=null){
		parent::__construct($id);
	}

    public function getSupervisor()
    {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;
        $this->markDirty();
        return $this;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;
        $this->markDirty();
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
        $this->markDirty();
        return $this;
    }
}