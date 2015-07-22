<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 8:48 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use \class_lib\utilities;

class AdminLoginCommand extends LoginCommand{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("admin_login_form");
        $requestContext->setResponseStatus(false);

        if( $requestContext->isExecutable() ){
	        $userId = $requestContext->getField("employeeId");
	        $password = $requestContext->getField("password");
            if( !empty($userId) and !empty($password)){
                $this->login($userId, $password, $requestContext);
            }else{
                $requestContext->setResponseError("staff ID or password not set");
            }
        }
    }
}