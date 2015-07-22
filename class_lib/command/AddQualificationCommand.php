<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:53 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use \class_lib\domain\Qualification;
use \class_lib\utilities\Date;

class AddQualificationCommand extends EmployeeCommand
{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("qualification_add_form");
	    if( $requestContext->isExecutable() ){ //carry out command execution
            $qualification = new Qualification();
            $qualification->setStaffId($requestContext->getUser()->get_employeeId());
            $qualification->setTitle($requestContext->getField("title"));
            $qualification->setCategory($requestContext->getField("category"));
            $date_obtained = new Date($requestContext->getField("date_m"),
                $requestContext->getField("date_d"), $requestContext->getField("date_y"));
            $qualification->setDateObtained($date_obtained);
            $qualification->setAwardingInstitution($requestContext->getField("institution"));
            $requestContext->setResponseData($qualification);
            $requestContext->resetContentViews();
        }else{
		    $qualification = new Qualification();
		    $qualification->setDateObtained(new Date());
		    $qualification->markClean();
		    $requestContext->setResponseData($qualification);
	    }
	    $requestContext->addContentView("qualifications_list_editor");
    }
}