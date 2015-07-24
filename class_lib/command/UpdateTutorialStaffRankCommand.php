<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/24/2015
 * Time: 3:41 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use class_lib\mapper\MapperRegistry;

class UpdateTutorialStaffRankCommand extends RankSettingsCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		parent::doExecute($requestContext);

		$id = $requestContext->getField("id");
		$mapper = MapperRegistry::getMapper("TutorialStaffRank");
		$rank = $mapper->find($id);

		if(is_object($rank)){
			$requestContext->addContentView("tutorial_staff_rank_update_form");
			if( $requestContext->isExecutable() ){ //carry out command execution

				$rank->setRankID($requestContext->getField("rank_id"));
				$rank->setTitle($requestContext->getField("title"));
				$rank->setMinYearOfService($requestContext->getField("min_year_of_service"));
				$rank->setMinQualification($requestContext->getField("min_qualification"));
				$rank->setMinNumOfPublications($requestContext->getField("min_num_publications"));
				$rank->setMinNumOfSupervisions($requestContext->getField("min_num_supervisions"));
				$rank->setMinScopusIndexes($requestContext->getField("min_num_scopus_indexes"));
				$rank->setMinThompsonIndexes($requestContext->getField("min_num_thompson_indexes"));

				$requestContext->setResponseStatus(true);
				$requestContext->setResponseError("Tutorial Staff Rank Updated Successfully.");
			}
			$requestContext->setResponseData($rank);
		}else{
			$requestContext->addCommand("ListTutorialStaffRanks");
		}
	}
}