<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/14/2015
 * Time: 11:37 PM
 */

namespace class_lib\command;

use \class_lib\Controller;

class AdminProfileDetailsCommand extends AdminCommand{
    protected function doExecute(Controller\RequestContext $requestContext){
        $requestContext->setSidebarView("admin_profile_sidebar");
        $requestContext->addContentView("admin_profile_details");
    }
}