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
use class_lib\domain\Publication;

class UpdatePublicationCommand extends StaffCommand{
    protected function doExecute(controller\RequestContext $requestContext){

        $publication_id = $requestContext->getField("publication_id");
        $mapper = Publication::getMapper("Publication");
        $publication = $mapper->find($publication_id);
        if(is_object($publication)){
            $requestContext->resetContentViews();
            $requestContext->addContentView("publication_update_form");
            if( $requestContext->isExecutable() ){ //carry out command execution
                $publication->setTitle($requestContext->getField("title"));
	            $publication->setAuthor($requestContext->getUser()->get_employeeId());
                $publication->setPublisher($requestContext->getField("publisher"));
                $publication->setYear($requestContext->getField("year"));
	            $indexed_by = $requestContext->fieldExists("indexed_by");
                $publication->setScopusIndexed($val = isset($indexed_by['scopus']) ? 1 : 0);
	            $publication->setThompsonIndexed($val = isset($indexed_by['thompson']) ? 1 : 0);
	            $publication->markPending();
                $requestContext->resetContentViews();
            }
	        $requestContext->setResponseData($publication);
            $requestContext->addContentView("publications_list_editor");
        }
    }
}