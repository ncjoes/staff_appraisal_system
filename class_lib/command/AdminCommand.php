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

abstract class AdminCommand extends Command
{
	function execute(controller\RequestContext $requestContext){
		$user = $requestContext->getUser();
		$user_class = "class_lib\\domain\\SystemAdmin";
		if($user instanceof $user_class){
			$requestContext->setMenuView("admin_menu_main");
			$requestContext->setSidebarView("admin_dashboard_sidebar");
			$this->doExecute($requestContext);
		}else{
			header("location:index.php");
		}
	}
}