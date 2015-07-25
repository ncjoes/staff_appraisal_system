<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 1:22 PM
 */

$requestContext = \class_lib\controller\RequestContext::instance();
$staff = $requestContext->getResponseData();;
$qualification = $staff->get_qualifications()->next();
?>
<form action="?cmd=AddTutorialStaff" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend>Add New Tutorial Staff</legend>
		<p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $requestContext->getResponseError(); ?>
		</p>
		<fieldset>
			<legend>Personal Details</legend>
			<?php require_once("personal_data_form_fields.php"); ?>
		</fieldset>
		<br/>
		<fieldset>
			<legend>Qualification</legend>
			<?php
			require_once("qualification_form_fields.php");
			?>
		</fieldset>
		<br/>
		<fieldset>
			<legend>Employment Details</legend>
			<p class="input_row">
				<label for="employee_id">Employee ID: <span class="required">*</span></label>
				<input name="employee_id" id="employee_id" type="text" value="<?= $staff->get_employeeId(); ?>" required/>
			</p>
			<p class="input_row">
				<label for="doe_m">Date of Employment: <span class="required">*</span></label>
				<select name="doe_m" id="doe_m" required>
					<option value=""> --Month-- </option>
					<script type="text/javascript">
						HtmlSelectOptions_Months("doe_m",  <?= $staff->get_employment_date()->get_month();?>);
					</script>
				</select>
				<input name="doe_d" id="doe_d" type="number" min="1" max="31" placeholder="Day"
				       value="<?= $staff->get_employment_date()->get_day();?>" required/>
				<input name="doe_y" id="doe_y" type="number" min="1900" max="2100" placeholder="year"
				       value="<?= $staff->get_employment_date()->get_year();?>" required/>
			</p>
			<p class="input_row">
				<label for="dor_m">Date of Retirement: <span class="required">*</span></label>
				<select name="dor_m" id="dor_m" required>
					<option value=""> --Month-- </option>
					<script type="text/javascript">
						HtmlSelectOptions_Months("dor_m",  <?= $staff->get_retirement_date()->get_month();?>);
					</script>
				</select>
				<input name="dor_d" id="dor_d" type="number" min="1" max="31" placeholder="Day"
				       value="<?= $staff->get_retirement_date()->get_day();?>" required/>
				<input name="dor_y" id="dor_y" type="number" min="1900" max="2100" placeholder="year"
				       value="<?= $staff->get_retirement_date()->get_year();?>" required/>
			</p>
		</fieldset>
		<br/>
		<fieldset>
			<legend>Login Details</legend>
			<p class="input_row">
				<label for="password">Password: <span class="required">*</span></label>
				<input name="password" id="password" value="" type="password" required/>
			</p>
			<p class="input_row">
				<label for="confirm_password">Confirm Password: <span class="required">*</span></label>
				<input name="confirm_password" id="confirm_password" value="" type="password" required/>
			</p>
		</fieldset>
		<p class="button_row">
			<input name="execute" value="Add Staff" type="submit"/>
		</p>
	</fieldset>
</form>