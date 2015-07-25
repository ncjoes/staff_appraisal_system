<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 6:19 PM
 */

namespace class_lib\command;

use \class_lib\controller;

class ChangePasswordCommand extends EmployeeCommand{
	protected function doExecute(controller\RequestContext $requestContext){
		$requestContext->addContentView("password_change_form");
		if( $requestContext->isExecutable() ){ //carry out command execution

			$accessData = $requestContext->getUser()->get_access_data();
			$current_password = $accessData->getPassword();

			$sent_current_password = $requestContext->getField("current_password");
			$new_password = $requestContext->getField("new_password");
			$confirm_password = $requestContext->getField("confirm_password");

			if( $current_password == $sent_current_password and $new_password == $confirm_password ){
				//do object manipulation
				$accessData->setPassword($new_password);

				$requestContext->setResponseStatus(true);
				$requestContext->setResponseError("Password Changed Successfully");
			}elseif($current_password != $sent_current_password){
				$requestContext->setResponseStatus(false);
				$requestContext->setResponseError("'Current Password' is not correct");
			}elseif( $new_password != $confirm_password ){
			$requestContext->setResponseStatus(false);
			$requestContext->setResponseError("'Password' and 'Confirm Password' fields did not match");
			}
		}
	}
}