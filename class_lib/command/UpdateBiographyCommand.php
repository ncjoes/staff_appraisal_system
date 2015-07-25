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
use class_lib\utilities\Date;

class UpdateBiographyCommand extends EmployeeCommand{
    protected function doExecute(controller\RequestContext $requestContext){
	    $requestContext->addContentView("staff_biography_update_form");
        if( $requestContext->isExecutable() ){ //carry out command execution
            $staff = $requestContext->getUser();
	        $string = $requestContext->getField("biography");
            if( strlen($string) >= 100 ){
                //do object manipulation
	            $staff->setBiography($string);
                $requestContext->setResponseStatus(true);
                $requestContext->setResponseError("Update successful");
            }else{
                $staff->setBiography($string);
                $staff->markClean();
                $requestContext->setResponseStatus(false);
                $requestContext->setResponseError("text must be at least 100 characters long");
            }
        }
    }
}