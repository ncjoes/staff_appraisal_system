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
use class_lib\domain\Qualification;

class ListQualificationsCommand extends EmployeeCommand{
    protected function doExecute(controller\RequestContext $requestContext){

	    $requestContext->addContentView("qualifications_list_editor");
	    $action = $requestContext->fieldExists("action");
	    $id = $requestContext->fieldExists("qualification_id");
        if($action and $id){
            //do object manipulation
	        switch($action){
		        case "Edit":{
			        $subCommand = new UpdateQualificationCommand();
			        $subCommand->execute($requestContext);
		        } break;
		        case "Delete":{
			        $mapper = Qualification::getMapper("Qualification");
			        $qualification_obj = $mapper->find($id);
			        if(is_object($qualification_obj)){
				        $qualification_obj->delete();
			        }
		        } break;
		        case "undoDelete":{
			        $mapper = Qualification::getMapper("Qualification");
			        $qualification_obj = $mapper->find($id);
			        if(is_object($qualification_obj)){
				        $qualification_obj->markPending();
			        }
		        } break;
	        }
        }
    }
}