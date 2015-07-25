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
$supervisions = $staff->get_supervisions();
$base_command = "ListSupervisions";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <tr>
        <th colspan="3" class="output_header1">
            <hr/><?= $staff->get_lastname().", ".$staff->get_firstname()." ".$staff->get_othernames() ?> : Supervisions<hr/>
        </th>
    </tr>
    </thead>
    <tr>
        <td class="button_row" colspan="3">
	        <p class="<?= $request->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
		        <?= $request->getResponseError(); ?>
	        </p>
            <a href="?cmd=AddSupervision">Add Supervision</a>
        </td>
    </tr>
    <?php
    $sn = 1;
    while ($supervision = $supervisions->next() ){
        ?>
        <tr>
            <td class="output_header2" rowspan="5" valign="top"><?= $sn; ?></td>
            <td class="output_header2" colspan="2"><?= $supervision->getProject(); ?></td>
        </tr>
        <tr>
            <td class="output_label">Title: </td>
            <td class="output_value"><?= $supervision->getProject(); ?></td>
        </tr>
        <tr>
            <td class="output_label">Year: </td>
            <td class="output_value"><?= $supervision->getYear(); ?></td>
        </tr>
	    <tr>
		    <td class="output_label" valign="top">Approval Status: </td>
		    <td class="output_value"><?= $supervision->getStatus(); ?></td>
	    </tr>

        <tr>
            <td colspan="2" class="button_row">
                <a href="?cmd=<?= $base_command; ?>&action=Edit&supervision_id=<?= $supervision->getId(); ?>">Edit</a>
                |
                <?php
                if($supervision->getStatus()=="Deleted"){
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=undoDelete&supervision_id=<?= $supervision->getId(); ?>">Undo Delete</a>
                    <?php
                }else{
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=Delete&supervision_id=<?= $supervision->getId(); ?>">Delete</a>
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