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

abstract class StaffCommand extends EmployeeCommand
{
	function execute(controller\RequestContext $requestContext){
		$user = $requestContext->getUser();
		$staff_class = "class_lib\\domain\\Staff";
		if($user instanceof $staff_class){
			$requestContext->setMenuView("staff_menu_main");
			$requestContext->setSidebarView("staff_profile_sidebar");
			$this->doExecute($requestContext);
		}else{
			header("location:index.php");
		}
	}
}