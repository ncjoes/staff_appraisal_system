<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 1:11 PM
 */

namespace class_lib\command;

use \class_lib\controller;
use \class_lib\domain;
use \class_lib\utilities\Date;

class AddTutorialStaffCommand extends AdminCommand{
	protected function doExecute(controller\RequestContext $requestContext){

		$requestContext->setSidebarView("admin_staff_list_sidebar");
		$requestContext->addContentView("tutorial_staff_add_form");

		if( $requestContext->isExecutable() ){ //carry out command execution

			$staff = new domain\TutorialStaff();
			$staffMapper = $staff->mapper();
			$probableStaffObject = $staffMapper->find($requestContext->getField("employee_id"));

			//do object manipulation
			$staff->set_lastname($requestContext->getField("lastname"))
				->set_firstname($requestContext->getField("firstname"))
				->set_othernames($requestContext->getField("othernames"))
				->set_gender($requestContext->getField("gender"))
				->set_dateOfBirth(new Date(
					$requestContext->getField("dob_m"),
					$requestContext->getField("dob_d"),
					$requestContext->getField("dob_y")
				))
				->set_nationality($requestContext->getField("nationality"))
				->set_state_of_origin($requestContext->getField("state_of_origin"))
				->set_lga($requestContext->getField("lga"))
				->set_employeeId($requestContext->getField("employee_id"))
				->set_employment_date(new Date(
					$requestContext->getField("doe_m"),
					$requestContext->getField("doe_d"),
					$requestContext->getField("doe_y")
				))
				->set_retirement_date(new Date(
					$requestContext->getField("dor_m"),
					$requestContext->getField("dor_d"),
					$requestContext->getField("dor_y")
				));

			$qualification = new domain\Qualification();
			$qualification->setTitle($requestContext->getField("title"))
				->setCategory($requestContext->getField("category"))
				->setDateObtained(new Date(
					$requestContext->getField("date_m"),
					$requestContext->getField("date_d"),
					$requestContext->getField("date_y")
				))
				->setAwardingInstitution($requestContext->getField("institution"));
			$staff->add_qualification($qualification);

			$accessData = new domain\AccessData();
			$accessData->setUsername($staff->get_employeeId())
				->setPassword($requestContext->getField("password"))
				->setUserType("TutorialStaff");
			$staff->set_access_data($accessData);

			if($requestContext->getField("confirm_password") == $requestContext->getField("password") and !is_object($probableStaffObject) ){

				domain\DomainObjectWatcher::instance()->performOperations();
				domain\AppraisalSystem::review($staff->get_employeeId());

				$requestContext->setResponseStatus(true);
				$requestContext->setResponseError("Tutorial Staff Profile Created Successful for {$staff->getShortName()}");
				$requestContext->resetContentViews();
				$requestContext->addCommand("ListStaff");

			}else{
				$error_message = array();
				if(is_object($probableStaffObject)){
					$error_message[]="The staff id '{$requestContext->getField("employee_id")}' is already assigned to another staff.";
				}
				if($requestContext->getField("password") != $requestContext->getField("confirm_password")){
					$error_message[]="'Password' and 'Confirm Password' fields did not match";
				}

				$staff->markClean();
				$accessData->markClean();
				$qualification->markClean();
				$requestContext->setResponseData($staff);
				$requestContext->setResponseError(implode("<br/>", $error_message));
			}

		}
		else{//default: non-executable request
			$staff = new domain\TutorialStaff();
			$staff->set_dateOfBirth(new Date());
			$qualification = new domain\Qualification();
			$qualification->setDateObtained(new Date());
			$staff->add_qualification($qualification);
			$staff->set_employment_date(new Date());
			$staff->set_retirement_date(new Date());
			$staff->markClean();
			$qualification->markClean();
			$requestContext->setResponseData($staff);
		}
	}
}