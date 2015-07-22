<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:46 PM
 */

namespace class_lib\Command;


use \class_lib\Controller;
use \class_lib\utilities;

class LogoutCommand extends LoginCommand{
    protected function doExecute(Controller\RequestContext $requestContext){

        if(utilities\Session::sessionExists()) {
            $session = utilities\Session::instance();
            $session->end();
        }

    }
}