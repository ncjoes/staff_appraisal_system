<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 8:56 PM
 */
$context = \class_lib\controller\RequestContext::instance();
?>
<form action="?cmd=AdminLogin" enctype="multipart/form-data" method="post">
    <fieldset>
        <legend>Admin Login</legend>
        <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
            <?= $context->getResponseError(); ?>
        </p>
        <p class="input_row">
            <label for="employeeId">Staff ID: </label>
            <input name="employeeId" id="employeeId" placeholder="" type="text" required/>
        </p>
        <p class="input_row">
            <label for="password">Password: </label>
            <input name="password" id="password" placeholder="" type="password" required/>
        </p>
        <p class="button_row">
            <input name="execute" value="Sign In" type="submit"/>
        </p>
    </fieldset>
</form>

