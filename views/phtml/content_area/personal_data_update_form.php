<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 11:10 PM
 */

$context = \class_lib\controller\RequestContext::instance();
$staff = $request_context->getUser();
?>
<form action="?cmd=UpdatePersonalData" enctype="multipart/form-data" method="post">
    <fieldset>
        <legend>Update Personal Data</legend>
        <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
            <?= $context->getResponseError(); ?>
        </p>

        <p class="input_row">
            <label for="lastname">Surname: <span class="required">*</span></label>
            <input name="lastname" id="lastname" type="text" value="<?= $staff->get_lastname(); ?>" required/>
        </p>
        <p class="input_row">
            <label for="firstname">Firstname: <span class="required">*</span></label>
            <input name="firstname" id="firstname" value="<?= $staff->get_firstname();?>" type="text" required/>
        </p>
        <p class="input_row">
            <label for="othernames">Other names: </label>
            <input name="othernames" id="othernames" value="<?= $staff->get_othernames();?>" type="text"/>
        </p>
        <p class="input_row">
            <label for="gender">Sex: <span class="required">*</span></label>
            <select name="gender" id="gender" required>
                <option value=""> </option>
                <option value="F" <?= $staff->get_gender()=="F" ? "selected" : ""; ?>> Female </option>
                <option value="M" <?= $staff->get_gender()=="M" ? "selected" : ""; ?>> Male </option>
            </select>
        </p>
        <p class="input_row">
            <label for="dob_m">Date of Birth: <span class="required">*</span></label>
            <select name="dob_m" id="dob_m" required>
                <option value=""> --Month-- </option>
                <script type="text/javascript">
	                HtmlSelectOptions_Months("dob_m",  <?= $staff->get_dateOfBirth()->get_month();?>);
                </script>
            </select>
            <input name="dob_d" id="dob_d" type="number" min="1" max="31" placeholder="Day"
                   value="<?= $staff->get_dateOfBirth()->get_day();?>" required/>
            <input name="dob_y" id="dob_y" type="number" min="1900" max="2100" placeholder="year"
                   value="<?= $staff->get_dateOfBirth()->get_year();?>" required/>
        </p>
        <p class="input_row">
            <label for="nationality">Nationality: <span class="required">*</span></label>
            <input name="nationality" id="nationality" value="<?= $staff->get_nationality();?>" type="text" required/>
        </p>
        <p class="input_row">
            <label for="state_of_origin">State of Origin: <span class="required">*</span></label>
            <input name="state_of_origin" id="state_of_origin" value="<?= $staff->get_state_of_origin();?>" type="text" required/>
        </p>
        <p class="input_row">
            <label for="lga">Local Govt. of Origin: <span class="required">*</span></label>
            <input name="lga" id="lga" value="<?= $staff->get_lga();?>" type="text" required/>
        </p>

        <p class="button_row">
            <input name="execute" value="Update Personal Data" type="submit"/>
        </p>
    </fieldset>
</form>

