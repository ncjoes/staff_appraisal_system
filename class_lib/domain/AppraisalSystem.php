<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/12/15
 * Time: 4:47 AM
 */

namespace class_lib\domain;

use class_lib\mapper\MapperRegistry;

abstract class AppraisalSystem {

	private static function getEmployeeType($employeeId){
		$accessDataMapper = MapperRegistry::getMapper("AccessData");
		$accessDataObject = $accessDataMapper->find($employeeId);
		$employeeType = $accessDataObject->getUserType();
		return $employeeType;
	}

	public static function review($employeeId){
		//1. Get Employee-Object Type
		$employeeType = self::getEmployeeType($employeeId);

		//2. Get Employee Object
		$employeeObjectMapper = MapperRegistry::getMapper($employeeType);
		$employeeObject = $employeeObjectMapper->find($employeeId);

		//3. Get Employee-Rank Collection
		$employeeRankMapper = MapperRegistry::getMapper("{$employeeType}Rank");
		$employeeRankCollection = $employeeRankMapper->findAll();//order from highest to lowest rank

		switch($employeeType){
			case "TutorialStaff":{
				foreach($employeeRankCollection as $rank){
					if(
						$employeeObject->hasQualification($rank->getMinQualification()) and
						$employeeObject->getYearsOfService() >= $rank->getMinYearOfService() and
						$employeeObject->getNumOfApprovedPublications() >= $rank->getMinNumOfPublications() and
						$employeeObject->getNumOfApprovedSupervisions() >= $rank->getMinNumOfSupervisions() and
						$employeeObject->getNumOfScopusIndexes() >= $rank->getMinScopusIndexes() and
						$employeeObject->getNumOfThompsonIndexes() >= $rank->getMinThompsonIndexes()
					){
						$employeeObject->setRank($rank->getRankID()); print_r($employeeObject);
						break;
					}
				}
			}break;

			default:{
				//do default stuff
			}
		}
	}
} 