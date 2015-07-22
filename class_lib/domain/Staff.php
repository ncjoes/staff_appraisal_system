<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 9:00 PM
 */

namespace class_lib\domain;


abstract class Staff extends Employee
{
	function __construct($id=null){
		parent::__construct($id);
	}

}