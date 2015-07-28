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
use class_lib\domain\Supervision;

class ListSupervisionsCommand extends StaffCommand{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("supervisions_list_editor");
        $action = $requestContext->fieldExists("action");
        $id = $requestContext->fieldExists("supervision_id");
        if($action and $id){
            //do object manipulation
            switch($action){
                case "Edit":{
                    $subCommand = new UpdateSupervisionCommand();
                    $subCommand->execute($requestContext);
                } break;
                case "Delete":{
                    $mapper = Supervision::getMapper("Supervision");
                    $supervision_obj = $mapper->find($id);
                    if(is_object($supervision_obj)){
                        $supervision_obj->delete();
                    }
                } break;
                case "undoDelete":{
                    $mapper = Supervision::getMapper("Supervision");
                    $supervision_obj = $mapper->find($id);
                    if(is_object($supervision_obj)){
                        $supervision_obj->markPending();
                    }
                } break;
            }
        }
    }
}