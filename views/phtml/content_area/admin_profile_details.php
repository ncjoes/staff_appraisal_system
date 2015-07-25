<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/17/2015
 * Time: 10:21 AM
 */

$request_context = \class_lib\Controller\RequestContext::instance();
$user = $request_context->getUser();
?>

<p class="<?= $request_context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
    <?= $context->getResponseError(); ?>
</p>
<table class="output_table">
    <thead>
        <th colspan="2" class="output_header1">
            Profile Details: <?= implode(' ', $user->get_names()) ?><hr/>
        </th>
    </thead>
    <tr>
        <td colspan="2" class="output_header2">
            PERSONAL INFORMATION
        </td>
    </tr>
    <tr>
        <td class="output_label">Surname</td>
        <td class="output_value"><?= $user->get_lastname(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Firstname </td>
        <td class="output_value"><?= $user->get_firstname(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Othernames</td>
        <td class="output_value"><?= $user->get_othernames(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Gender</td>
        <td class="output_value"><?= $user->get_gender(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Date of Birth</td>
        <td class="output_value"><?= $user->get_dateOfBirth()->toStr(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Nationality</td>
        <td class="output_value"><?= $user->get_nationality(); ?></td>
    </tr>
    <tr>
        <td class="output_label">State of Origin</td>
        <td class="output_value"><?= $user->get_state_of_origin(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Local Government Area</td>
        <td class="output_value"><?= $user->get_lga(); ?></td>
    </tr>
    <tr>
        <td colspan="2" class="output_header2">
            <br/>EMPLOYMENT DETAILS
        </td>
    </tr>
    <tr>
        <td class="output_label">Staff ID</td>
        <td class="output_value"><?= $user->get_employeeId(); ?></td>
    </tr>

    <tr>
        <td class="output_label">Date of Employment</td>
        <td class="output_value"><?= $user->get_employment_date()->toStr(); ?></td>
    </tr>
    <tr>
        <td class="output_label">Date of Retirement</td>
        <td class="output_value"><?= $user->get_retirement_date()->toStr(); ?></td>
    </tr>
    <tr>
        <td colspan="2" class="output_header2">
            <br/>CREDENTIALS
        </td>
    </tr>
    <tr>
        <td class="output_label" valign="top">Qualifications</td>
        <td class="output_value">
            <?= $user->get_qualifications()->size(); ?> qualification(s)
            <a href="?cmd=ListQualifications"> view all </a>
        </td>
    </tr>

</table>
