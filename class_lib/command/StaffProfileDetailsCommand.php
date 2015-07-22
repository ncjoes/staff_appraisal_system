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

class StaffProfileDetailsCommand extends StaffCommand{
    protected function doExecute(Controller\RequestContext $requestContext){
        $requestContext->addContentView("staff_profile_details");
    }
}