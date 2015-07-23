<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 11:10 PM
 */
$context = \class_lib\controller\RequestContext::instance();
$supervision = $context->getResponseData();
?>
<form action="?cmd=ListSupervisions" enctype="multipart/form-data" method="post">
    <input type="hidden" name="action" value="Edit"/>
    <fieldset>
        <legend>Update Supervision</legend>
        <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
            <?= $context->getResponseError(); ?>
        </p>
        <?php include("supervision_form_fields.php"); ?>
        <p class="button_row">
            <input name="execute" value="Update Supervision" type="submit"/>
        </p>
    </fieldset>
</form>