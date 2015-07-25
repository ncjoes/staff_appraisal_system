<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:47 PM
 */

$request = \class_lib\Controller\RequestContext::instance();
$staff = $request->getUser();
$qualifications = $staff->get_qualifications();
$base_command = "ListQualifications";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <tr>
        <th colspan="3" class="output_header1">
	        <hr/><?= $staff->get_lastname().", ".$staff->get_firstname()." ".$staff->get_othernames() ?> : Qualifications<hr/>
        </th>
    </tr>
    </thead>
	<tr>
		<td class="button_row" colspan="3">
            <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
                <?= $context->getResponseError(); ?>
            </p>
			<a href="?cmd=AddQualification">Add Qualification</a>
		</td>
	</tr>
    <?php
    $sn = 1;
    while ($qualification = $qualifications->next() ){
    ?>
        <tr>
            <td class="output_header2" rowspan="6" valign="top"><?= $sn; ?></td>
            <td class="output_header2" colspan="2"><?= $qualification->getTitle(); ?></td>
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
	            <a href="?cmd=<?= $base_command; ?>&action=Edit&qualification_id=<?= $qualification->getId(); ?>">Edit</a>
	            |
                <?php
                if($qualification->getStatus()=="Deleted"){
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=undoDelete&qualification_id=<?= $qualification->getId(); ?>">Undo Delete</a>
                    <?php
                }else{
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=Delete&qualification_id=<?= $qualification->getId(); ?>">Delete</a>
                    <?php
                }
                ?>
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