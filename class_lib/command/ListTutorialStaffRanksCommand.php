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

class ListTutorialStaffRanksCommand extends RankSettingsCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		parent::doExecute($requestContext);

		$requestContext->addContentView("tutorial_staff_ranks_list_editor");

		$mapper = MapperRegistry::getMapper("TutorialStaffRank");
		$requestContext->setResponseData($mapper->findAll());
	}
}