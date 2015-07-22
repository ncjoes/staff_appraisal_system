<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:29 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use class_lib\domain\Qualification;
use class_lib\utilities\Date;

class UpdateQualificationCommand extends EmployeeCommand{
    protected function doExecute(controller\RequestContext $requestContext){

	    $qualification_id = $requestContext->getField("qualification_id");
	    $mapper = Qualification::getMapper("Qualification");
	    $qualification = $mapper->find($qualification_id);
	    if(is_object($qualification)){
		    $requestContext->resetContentViews();
		    $requestContext->addContentView("qualification_update_form");
		    if( $requestContext->isExecutable() ){ //carry out command execution
			    $qualification->setTitle($requestContext->getField("title"));
			    $qualification->setCategory($requestContext->getField("category"));
			    $date_obtained = new Date($requestContext->getField("date_m"),
				    $requestContext->getField("date_d"), $requestContext->getField("date_y"));
			    $qualification->setDateObtained($date_obtained);
			    $qualification->setAwardingInstitution($requestContext->getField("institution"));
			    $qualification->markPending();
			    $requestContext->resetContentViews();
		    }
		    $requestContext->setResponseData($qualification);
		    $requestContext->addContentView("qualifications_list_editor");
	    }
    }
}