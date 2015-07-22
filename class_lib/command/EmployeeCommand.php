<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 2:43 AM
 */

namespace class_lib\command;

use \class_lib\controller;

abstract class EmployeeCommand extends Command
{
	function execute(controller\RequestContext $requestContext){
		$user = $requestContext->getUser();
		$staff_class = "class_lib\\domain\\Staff";
		if($user instanceof $staff_class){
			$requestContext->setMenuView("staff_menu_main");
			$requestContext->setSidebarView("staff_profile_sidebar");
			$this->doExecute($requestContext);
		}
		$admin_class = "class_lib\\domain\\SystemAdmin";
		if($user instanceof $admin_class){
			$requestContext->setMenuView("admin_menu_main");
			$requestContext->setSidebarView("admin_profile_sidebar");
			$this->doExecute($requestContext);
		}
	}
}