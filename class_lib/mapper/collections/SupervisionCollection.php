<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 12:05 AM
 */

namespace class_lib\mapper\collections;


class SupervisionCollection extends Collection{

    function targetClass(){
        return "class_lib\\domain\\Supervision";
    }
}