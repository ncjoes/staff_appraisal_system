<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:45 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use \class_lib\domain\AppraisalSystem;
use class_lib\domain\DomainObjectWatcher;
use \class_lib\mapper\MapperRegistry;

class ReviewQualificationsCommand extends AdminCommand{
    protected function doExecute(controller\RequestContext $requestContext){

	    $requestContext->addContentView("qualifications_update_reviewer");
	    $action = $requestContext->fieldExists("action");
	    $id = $requestContext->fieldExists("id");
	    $state = $requestContext->fieldExists("state");
	    $state = ($state != false) ? $state : "Pending";
	    $mapper = MapperRegistry::getMapper("Qualification");
	    $obj = $mapper->find($id);
	    if($action and $id and is_object($obj)){
		    //do object manipulation
		    switch($action)
		    {
			    case "approve":{
				    $obj->approve();
			    } break;
			    case "ignore":{
				    $obj->ignore();
			    } break;
			    case "pend":{
				    $obj->markPending();
			    } break;
			    case "delete":{
				    $obj->delete();
				    $obj->markDelete();
			    } break;
		    }

		    //do appraisal stuff
		    $staff_id = $obj->getStaffId();
		    DomainObjectWatcher::instance()->performOperations();
		    AppraisalSystem::review($staff_id);
	    }
	    $requestContext->setResponseData(array($state,$mapper->findByStatus($state)));
    }
}