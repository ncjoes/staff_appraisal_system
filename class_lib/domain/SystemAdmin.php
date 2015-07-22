<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/12/15
 * Time: 11:38 AM
 */

namespace class_lib\domain;


class SystemAdmin extends Employee{
    function __construct($id=null){
        parent::__construct($id);
    }
} 