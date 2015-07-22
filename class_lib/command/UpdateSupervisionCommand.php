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
use class_lib\mapper\MapperRegistry;

class UpdateSupervisionCommand extends StaffCommand{
    protected function doExecute(controller\RequestContext $requestContext){

        $supervision_id = $requestContext->getField("supervision_id");
        $mapper = MapperRegistry::getMapper("Supervision");
        $supervision = $mapper->find($supervision_id);
        if(is_object($supervision)){
            $requestContext->resetContentViews();
            $requestContext->addContentView("supervision_update_form");
            if( $requestContext->isExecutable() ){ //carry out command execution
                $supervision->setProject($requestContext->getField("project"));
                $supervision->setSupervisor($requestContext->getUser()->get_employeeId());
                $supervision->setYear($requestContext->getField("year"));
                $supervision->markPending();
                $requestContext->resetContentViews();
            }
            $requestContext->setResponseData($supervision);
            $requestContext->addContentView("supervisions_list_editor");
        }
    }
}