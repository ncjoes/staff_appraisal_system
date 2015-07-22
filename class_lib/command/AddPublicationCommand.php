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
use \class_lib\domain\Publication;

class AddPublicationCommand extends StaffCommand
{
    protected function doExecute(controller\RequestContext $requestContext){

        $requestContext->addContentView("publication_add_form");
        if( $requestContext->isExecutable() ){ //carry out command execution
            $publication = new Publication();
            $publication->setTitle($requestContext->getField("title"));
            $publication->setAuthor($requestContext->getUser()->get_employeeId());
            $publication->setPublisher($requestContext->getField("publisher"));
            $publication->setYear($requestContext->getField("year"));
            $indexed_by = $requestContext->fieldExists("indexed_by");
            $publication->setScopusIndexed($val = isset($indexed_by['scopus']) ? 1 : 0);
            $publication->setThompsonIndexed($val = isset($indexed_by['thompson']) ? 1 : 0);
            $requestContext->resetContentViews();
        }else{
            $publication = new Publication();
            $publication->markClean();
            $requestContext->setResponseData($publication);
        }
        $requestContext->addContentView("publications_list_editor");
    }
}