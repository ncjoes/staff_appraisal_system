<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:44 PM
 */

namespace class_lib\Command;

use \class_lib\utilities;
use \class_lib\controller;

abstract class LoginCommand extends Command{
	function execute(controller\RequestContext $requestContext){

		$requestContext->setMenuView("login_menu");
		$requestContext->setSidebarView("login_sidebar");
		$this->doExecute($requestContext);
	}

	function login($userId, $password, controller\RequestContext $requestContext){
		$manager = utilities\AccessManager::instance();
		$user_obj = $manager->login( $userId, $password );
		if ( is_object( $user_obj ) ) {
			//start session
			$session = utilities\Session::instance();
			$session->setUser($user_obj);
			$requestContext->setUser( $user_obj );
			$requestContext->setResponseStatus(true);
		}
		$requestContext->setResponseError( $manager->getError() );
	}
}