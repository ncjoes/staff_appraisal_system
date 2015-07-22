<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 1:32 AM
 */

namespace class_lib\domain;


class EmployeeRank extends DomainObject
{
	private $rankNum;
	private $title;
	private $minQualification;
	private $minYearOfService;
	private $minNumOfSupervisions;
	private $minNumOfPublications;
	private $minScopusIndexes;
	private $minThompsonIndexes;

	function __construct($id){
		parent::__construct($id);
	}

	public function getRankNum()
	{
		return $this->rankNum;
	}

	public function setRankNum($rankNum)
	{
		$this->rankNum = $rankNum;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function getMinQualification()
	{
		return $this->minQualification;
	}

	public function setMinQualification($minQualification)
	{
		$this->minQualification = $minQualification;
		return $this;
	}

	public function getMinYearOfService()
	{
		return $this->minYearOfService;
	}

	public function setMinYearOfService($minYearOfService)
	{
		$this->minYearOfService = $minYearOfService;
		return $this;
	}

	public function getMinNumOfSupervisions()
	{
		return $this->minNumOfSupervisions;
	}

	public function setMinNumOfSupervisions($minNumOfSupervisions)
	{
		$this->minNumOfSupervisions = $minNumOfSupervisions;
		return $this;
	}

	public function getMinNumOfPublications()
	{
		return $this->minNumOfPublications;
	}

	public function setMinNumOfPublications($minNumOfPublications)
	{
		$this->minNumOfPublications = $minNumOfPublications;
		return $this;
	}

	public function getMinScopusIndexes()
	{
		return $this->minScopusIndexes;
	}

	public function setMinScopusIndexes($minScopusIndexes)
	{
		$this->minScopusIndexes = $minScopusIndexes;
		return $this;
	}

	public function getMinThompsonIndexes()
	{
		return $this->minThompsonIndexes;
	}

	public function setMinThompsonIndexes($minThompsonIndexes)
	{
		$this->minThompsonIndexes = $minThompsonIndexes;
		return $this;
	}

}