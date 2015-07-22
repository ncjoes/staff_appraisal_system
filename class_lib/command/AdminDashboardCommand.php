<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 10:24 PM
 */

namespace class_lib\command;

use class_lib\controller;

class AdminDashboardCommand extends AdminCommand
{
	function doExecute(controller\RequestContext $requestContext){
		//get data from database and put in $requestContext->response data

		$requestContext->addContentView("admin_dashboard_main");
	}

}