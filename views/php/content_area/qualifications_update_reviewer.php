<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:47 PM
 */

$request = \class_lib\Controller\RequestContext::instance();
$state = $request->getResponseData()[0];
$qualifications = $request->getResponseData()[1];
$base_command = "ReviewQualifications";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <th colspan="3" class="output_header1">
        <hr/>Qualifications Review: <?= $state; ?><hr/>
    </th>
    </thead>
    <tr>
        <td class="button_row" colspan="3">
            <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
                <?= $context->getResponseError(); ?>
            </p>
	        <a href="?cmd=<?= $base_command; ?>&state=Pending">Pending</a> |
	        <a href="?cmd=<?= $base_command; ?>&state=Approved">Approved</a> |
	        <a href="?cmd=<?= $base_command; ?>&state=Ignored">Ignored</a> |
	        <a href="?cmd=<?= $base_command; ?>&state=Deleted">Deleted</a>
        </td>
    </tr>
	<tr><td colspan="3"><hr/></td></tr>
    <?php
    $sn = 1;
    while ($qualification = $qualifications->next() ){
        ?>
        <tr>
	        <td class="output_header2" rowspan="7" valign="top"><?= $sn; ?></td>
	        <td class="output_label">Staff ID: </td>
	        <td class="output_value"><?= $qualification->getStaffId(); ?></td>
        </tr>
	    <tr>
		    <td class="output_label">Title: </td>
		    <td class="output_value"><?= $qualification->getTitle(); ?></td>
	    </tr>
	    <tr>
		    <td class="output_label">Category: </td>
		    <td class="output_value"><?= $qualification->getCategory(); ?></td>
	    </tr>
        <tr>
            <td class="output_label">Date Obtained: </td>
            <td class="output_value"><?= $qualification->getDateObtained()->toStr(); ?></td>
        </tr>
        <tr>
            <td class="output_label">Awarding Institution: </td>
            <td class="output_value"><?= $qualification->getAwardingInstitution(); ?></td>
        </tr>
        <tr>
            <td class="output_label" valign="top">Approval Status: </td>
            <td class="output_value"><?= $qualification->getStatus(); ?></td>
        </tr>

        <tr>
            <td colspan="2" class="button_row">
	            <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=approve&id=<?= $qualification->getId(); ?>">Approve</a> |
	            <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=ignore&id=<?= $qualification->getId(); ?>">Ignore</a> |
	            <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=pend&id=<?= $qualification->getId(); ?>">Keep Pending</a> |
	            <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=delete&id=<?= $qualification->getId(); ?>">Delete Permanently</a>
                <br/><br/>
            </td>
        </tr>
        <?php
        $sn++;
    }
    ?>
    <tr>
        <td colspan="3"><hr/></td>
    </tr>
</table>