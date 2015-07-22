<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 11:56 PM
 */

namespace class_lib\mapper\collections;

class PublicationCollection extends Collection{

    function targetClass( ) {
        return "class_lib\\domain\\Publication";
    }
}