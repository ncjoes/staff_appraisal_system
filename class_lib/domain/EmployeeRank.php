<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/23/2015
 * Time: 8:57 PM
 */

namespace class_lib\domain;


class EmployeeRank extends DomainObject
{
	private $rankID;
	private $rankOrder;
	private $title;

	function __construct($id=null){
		parent::__construct($id);
	}

	public function getRankID()
	{
		return $this->rankID;
	}

	public function setRankID($rankID)
	{
		$this->rankID = $rankID;
		$this->markDirty();
		return $this;
	}

	public function getOrder(){
		return $this->rankOrder;
	}

	public function setOrder($order){
		$this->rankOrder = (int)$order;
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

}