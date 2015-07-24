<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/23/2015
 * Time: 10:43 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use class_lib\mapper\MapperRegistry;

class ReOrderTutorialStaffRanksCommand extends RankSettingsCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		parent::doExecute($requestContext);

		$requestContext->addContentView("tutorial_staff_ranks_order_editor");
		$mapper = MapperRegistry::getMapper("TutorialStaffRank");
		$allRanks = $mapper->findAll();

		if( $requestContext->isExecutable() ) { //carry out command execution
			$sent_orders = $requestContext->getField("orders");
			$unique_orders = array();
			foreach ($sent_orders as $rankID => $rankOrder) {
				$unique_orders[$rankOrder] = $rankID;
			}
			if(sizeof($sent_orders) == sizeof($unique_orders)){
				foreach($allRanks as $rank){
					if( isset( $sent_orders[$rank->getRankID()] ) ){
						$rank->setOrder( $sent_orders[$rank->getRankID()] );
					}
				}
				$requestContext->setResponseStatus(true);
				$requestContext->setResponseError("Ranks Re-ordered Successfully");
			}else{
				$requestContext->setResponseStatus(false);
				$requestContext->setResponseError("Duplicate values found in rank orders");
			}
		}

		$requestContext->setResponseData($allRanks);
	}
}