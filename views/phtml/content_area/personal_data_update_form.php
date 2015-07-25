<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 11:10 PM
 */

$requestContext = \class_lib\controller\RequestContext::instance();
$staff = $requestContext->getUser();
?>
<form action="?cmd=UpdatePersonalData" enctype="multipart/form-data" method="post">
    <fieldset>
        <legend>Update Personal Data</legend>
        <p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
            <?= $requestContext->getResponseError(); ?>
        </p>

        <?php require_once("personal_data_form_fields.php"); ?>

        <p class="button_row">
            <input name="execute" value="Update Personal Data" type="submit"/>
        </p>
    </fieldset>
</form>