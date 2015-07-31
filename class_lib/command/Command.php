<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 12:36 AM
 */

namespace class_lib\Command;

use \class_lib\controller;

abstract class Command {
    public abstract function execute(controller\RequestContext $requestContext);
    protected abstract function doExecute(controller\RequestContext $requestContext);
} 