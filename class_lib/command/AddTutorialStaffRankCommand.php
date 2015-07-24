<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/24/2015
 * Time: 3:24 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use \class_lib\domain\TutorialStaffRank;

class AddTutorialStaffRankCommand extends RankSettingsCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		parent::doExecute($requestContext);

		$requestContext->addContentView("tutorial_staff_rank_add_form");
		if( $requestContext->isExecutable() ){ //carry out command execution

			$rank = new TutorialStaffRank();
			$rank->setRankID($requestContext->getField("rank_id"));
			$rank->setOrder( $rank->mapper()->findAll()->size()+1 );
//			$rank->setOrder($requestContext->getField("rank_order"));
			$rank->setTitle($requestContext->getField("title"));
			$rank->setMinYearOfService($requestContext->getField("min_year_of_service"));
			$rank->setMinQualification($requestContext->getField("min_qualification"));
			$rank->setMinNumOfPublications($requestContext->getField("min_num_publications"));
			$rank->setMinNumOfSupervisions($requestContext->getField("min_num_supervisions"));
			$rank->setMinScopusIndexes($requestContext->getField("min_num_scopus_indexes"));
			$rank->setMinThompsonIndexes($requestContext->getField("min_num_thompson_indexes"));

			$requestContext->resetContentViews();
			$requestContext->setResponseStatus(true);
			$requestContext->setResponseError("Tutorial Staff Rank Added Successfully.");
			$requestContext->addCommand("ListTutorialStaffRanks");

		}else{//default
			$rank = new TutorialStaffRank();
			$rank->markClean();
			$requestContext->setResponseData($rank);
		}
	}
}