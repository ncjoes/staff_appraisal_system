<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 12:44 PM
 */

namespace class_lib\mapper\collections;


class TutorialStaffCollection extends EmployeeCollection{
	function targetClass(){
		return "class_lib\\domain\\TutorialStaff";

	}
}