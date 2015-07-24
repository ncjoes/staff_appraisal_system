<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/23/2015
 * Time: 11:00 PM
 */

namespace class_lib\command;

use \class_lib\controller;

abstract class RankSettingsCommand extends AdminCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		$requestContext->setSidebarView("admin_rank_settings_sidebar");
	}
}