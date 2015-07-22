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

class UpdatePersonalDataCommand extends EmployeeCommand{
    protected function doExecute(controller\RequestContext $requestContext){
	    $requestContext->addContentView("personal_data_update_form");
        if( $requestContext->isExecutable() ){ //carry out command execution
            if( true /*dummy*/ ){
                //do object manipulation
                $staff = $requestContext->getUser();
	            $staff->set_lastname($requestContext->getField("lastname"))
		            ->set_firstname($requestContext->getField("firstname"))
		            ->set_othernames($requestContext->getField("othernames"))
	                ->set_gender($requestContext->getField("gender"))
	                ->set_dateOfBirth(new Date(
		                $requestContext->getField("dob_m"),
		                $requestContext->getField("dob_d"),
		                $requestContext->getField("dob_y")
		                ))
	                ->set_nationality($requestContext->getField("nationality"))
	                ->set_state_of_origin($requestContext->getField("state_of_origin"))
	                ->set_lga($requestContext->getField("lga"));
	            $requestContext->setResponseStatus(true);
	            $requestContext->setResponseError("Update successful");
            }else{
                $requestContext->setResponseStatus(false);
                $requestContext->setResponseError("error message");
            }
        }
    }
}