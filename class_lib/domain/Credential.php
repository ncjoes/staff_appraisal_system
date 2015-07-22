<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/21/2015
 * Time: 12:14 AM
 */

namespace class_lib\domain;


class Credential extends DomainObject
{
	private $status;

	//the order of this array must be maintained as it is
	private $states = array(0=>"Pending",1=>"Approved",2=>"Ignored",3=>"Deleted");

	function __construct($id=null){
		parent::__construct($id);
		if(is_null($id)){
			$this->status = $this->states[0];
		}
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		if(in_array($status, $this->states)){
			$this->status = $status;
			$this->markDirty();
			return $this;
		}
		throw new \Exception("Invalid supplied for credential");
	}

	public function isPending()
	{
		return ($status = $this->status == $this->states[0] ? true : false);
	}

	public function isApproved()
	{
		return ($status = $this->status == $this->states[1] ? true : false);
	}

	public function isIgnored()
	{
		return ($status = $this->status == $this->states[2] ? true : false);
	}

	public function markPending(){
		$this->status = $this->states[0];
		$this->markDirty();
		return $this;
	}

	public function approve()
	{
		$this->status = $this->states[1];
		$this->markDirty();
		return $this;
	}

	public function ignore(){
		$this->status = $this->states[2];
		$this->markDirty();
		return $this;
	}

	public function delete(){
		$this->status = $this->states[3];
		$this->markDirty();
		return $this;
	}
}