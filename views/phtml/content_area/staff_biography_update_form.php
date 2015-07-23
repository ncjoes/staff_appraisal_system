<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 12:02 AM
 */
$context = \class_lib\controller\RequestContext::instance();
$staff = $context->getUser();
?>
<form action="?cmd=UpdateBiography" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend>Update Biography</legend>
		<label class="output_header2" for="biography">
		<hr/>
			<?= $staff->get_lastname().", ".$staff->get_firstname()." ".$staff->get_othernames() ?> : Biography
		<hr/>
		</label>
		<p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $context->getResponseError(); ?>
		</p>
		<p class="input_textEditor">
			<textarea name="biography" id="biography"><?= $staff->getBiography(); ?></textarea>
		</p>
		<p class="button_row">
			<input name="execute" value="Update Biography" type="submit"/>
		</p>
	</fieldset>
</form>