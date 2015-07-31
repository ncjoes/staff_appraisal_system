<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 3:54 AM
 */

namespace class_lib\command;

use \class_lib\controller;
use class_lib\utilities\Session;

class DefaultCommand extends Command
{
	function execute(controller\RequestContext $requestContext){
		$this->doExecute($requestContext);
	}

	protected function doExecute(controller\RequestContext $requestContext){
		$session = Session::instance();
		$user_type_path = explode("\\",$session->getUserType());
		$user_type = $user_type_path[sizeof($user_type_path)-1];
		switch($user_type){
			case "TutorialStaff" : {
				$requestContext->addCommand("StaffProfileDetails");
			} break;
			case "SystemAdmin" : {
				$requestContext->addCommand("AdminDashboard");
			} break;
			case "Guest" : {

			}
			Default : {
				$requestContext->addCommand("StaffLogin");
			}
		}
	}
}