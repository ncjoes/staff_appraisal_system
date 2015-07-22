<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 11:10 PM
 */
$context = \class_lib\controller\RequestContext::instance();
$qualification = $context->getResponseData();
?>
<form action="?cmd=ListQualifications" enctype="multipart/form-data" method="post">
	<input type="hidden" name="action" value="Edit"/>
    <fieldset>
        <legend>Update Qualification</legend>
        <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
            <?= $context->getResponseError(); ?>
        </p>
		<?php include("qualification_form_fields.php"); ?>
        <p class="button_row">
            <input name="execute" value="Update Qualification" type="submit"/>
        </p>
    </fieldset>
</form>

