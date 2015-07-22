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
$supervisions = $request->getResponseData()[1];
$base_command = "ReviewSupervisions";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <th colspan="3" class="output_header1">
        <hr/>Supervisions Review: <?= $state; ?><hr/>
    </th>
    </thead>
    <tr>
        <td class="button_row" colspan="3">
            <p class="<?= $request->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
                <?= $request->getResponseError(); ?>
            </p>
            <a href="?cmd=<?= $base_command; ?>&state=Pending">Pending</a> |
            <a href="?cmd=<?= $base_command; ?>&state=Approved">Approved</a> |
            <a href="?cmd=<?= $base_command; ?>&state=Ignored">Ignored</a> |
            <a href="?cmd=<?= $base_command; ?>&state=Deleted">Deleted</a>
        </td>
    </tr>
    <?php
    $sn = 1;
    while ($supervision = $supervisions->next() ){
        ?>
        <tr>
            <td class="output_header2" rowspan="5" valign="top"><?= $sn; ?></td>
            <td class="output_label">Staff ID: </td>
            <td class="output_value"><?= $supervision->getSupervisor(); ?></td>
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
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=approve&id=<?= $supervision->getId(); ?>">Approve</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=ignore&id=<?= $supervision->getId(); ?>">Ignore</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=pend&id=<?= $supervision->getId(); ?>">Keep Pending</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=delete&id=<?= $supervision->getId(); ?>">Delete Permanently</a>
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