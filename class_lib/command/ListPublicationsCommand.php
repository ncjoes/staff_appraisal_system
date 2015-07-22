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
use class_lib\mapper\MapperRegistry;

class ListPublicationsCommand extends StaffCommand{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("publications_list_editor");
        $action = $requestContext->fieldExists("action");
        $id = $requestContext->fieldExists("publication_id");
        if($action and $id){
            //do object manipulation
            switch($action){
                case "Edit":{
                    $subCommand = new UpdatePublicationCommand();
                    $subCommand->execute($requestContext);
                } break;
                case "Delete":{
                    $mapper = MapperRegistry::getMapper("Publication");
                    $publication_obj = $mapper->find($id);
                    if(is_object($publication_obj)){
                        $publication_obj->delete();
                        //$user = $requestContext->getUser();
                        //$user->remove_publication($publication_obj);
                    }
                } break;
            }
        }
    }
}