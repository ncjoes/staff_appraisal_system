<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 6:21 PM
 */

$requestContext = \class_lib\controller\RequestContext::instance();
?>
<form action="?cmd=ChangePassword" enctype="multipart/form-data" method="post">
<fieldset>
	<legend>Login Details</legend>
	<p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
		<?= $requestContext->getResponseError(); ?>
	</p>
	<p class="input_row">
		<label for="current_password">Current Password: <span class="required">*</span></label>
		<input name="current_password" id="current_password" value="" type="password" required/>
	</p>
	<p class="input_row">
		<label for="new_password">New Password: <span class="required">*</span></label>
		<input name="new_password" id="new_password" value="" type="password" required/>
	</p>
	<p class="input_row">
		<label for="confirm_password">Confirm Password: <span class="required">*</span></label>
		<input name="confirm_password" id="confirm_password" value="" type="password" required/>
	</p>
	<p class="button_row">
		<input name="execute" value="Change Password" type="submit"/>
	</p>
</fieldset>
</form>