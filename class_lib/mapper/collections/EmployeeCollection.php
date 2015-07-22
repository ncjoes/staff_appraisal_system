<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 12:39 PM
 */

namespace class_lib\mapper\collections;


class EmployeeCollection extends Collection{

    function targetClass(){
        return "class_lib\\domain\\Employee";

    }
}