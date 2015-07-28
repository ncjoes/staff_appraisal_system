<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 12:24 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use class_lib\domain\Staff;

class ListStaffCommand extends AdminCommand{
	protected function doExecute(controller\RequestContext $requestContext){

		$requestContext->setSidebarView("admin_staff_list_sidebar");
		$requestContext->addContentView("tutorial_staff_list_editor");

		$mapper = Staff::getMapper("TutorialStaff");
		$requestContext->setResponseData($mapper->findAll());
	}
}