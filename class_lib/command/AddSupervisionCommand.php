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
use \class_lib\domain\Supervision;

class AddSupervisionCommand extends StaffCommand
{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("supervision_add_form");
        if( $requestContext->isExecutable() ){ //carry out command execution
            $supervision = new Supervision();
            $supervision->setProject($requestContext->getField("project"));
            $supervision->setSupervisor($requestContext->getUser()->get_employeeId());
            $supervision->setYear($requestContext->getField("year"));
            $requestContext->resetContentViews();
        }else{
            $supervision = new Supervision();
            $supervision->markClean();
            $requestContext->setResponseData($supervision);
        }
        $requestContext->addContentView("supervisions_list_editor");
    }
}