<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 1:32 AM
 */

namespace class_lib\domain;


class TutorialStaffRank extends EmployeeRank
{
	private $minQualification;
	private $minYearOfService;
	private $minNumOfSupervisions;
	private $minNumOfPublications;
	private $minScopusIndexes;
	private $minThompsonIndexes;

	function __construct($id = null){
		parent::__construct($id);
	}

	public function getMinQualification()
	{
		return $this->minQualification;
	}

	public function setMinQualification($minQualification)
	{
		$this->minQualification = $minQualification;
		$this->markDirty();
		return $this;
	}

	public function getMinYearOfService()
	{
		return $this->minYearOfService;
	}

	public function setMinYearOfService($minYearOfService)
	{
		$this->minYearOfService = $minYearOfService;
		$this->markDirty();
		return $this;
	}

	public function getMinNumOfSupervisions()
	{
		return $this->minNumOfSupervisions;
	}

	public function setMinNumOfSupervisions($minNumOfSupervisions)
	{
		$this->minNumOfSupervisions = $minNumOfSupervisions;
		$this->markDirty();
		return $this;
	}

	public function getMinNumOfPublications()
	{
		return $this->minNumOfPublications;
	}

	public function setMinNumOfPublications($minNumOfPublications)
	{
		$this->minNumOfPublications = $minNumOfPublications;
		$this->markDirty();
		return $this;
	}

	public function getMinScopusIndexes()
	{
		return $this->minScopusIndexes;
	}

	public function setMinScopusIndexes($minScopusIndexes)
	{
		$this->minScopusIndexes = $minScopusIndexes;
		$this->markDirty();
		return $this;
	}

	public function getMinThompsonIndexes()
	{
		return $this->minThompsonIndexes;
	}

	public function setMinThompsonIndexes($minThompsonIndexes)
	{
		$this->minThompsonIndexes = $minThompsonIndexes;
		$this->markDirty();
		return $this;
	}

}