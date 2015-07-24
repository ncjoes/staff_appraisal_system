<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 3:47 PM
 */

$requestContext = \class_lib\Controller\RequestContext::instance();
$state = $requestContext->getResponseData()[0];
$publications = $requestContext->getResponseData()[1];
$base_command = "ReviewPublications";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <th colspan="3" class="output_header1">
        <hr/>Publications Review: <?= $state; ?><hr/>
    </th>
    </thead>
    <tr>
        <td class="button_row" colspan="3">
	        <p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
		        <?= $requestContext->getResponseError(); ?>
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
    while ($publication = $publications->next() ){
        ?>
        <tr>
            <td class="output_header2" rowspan="7" valign="top"><?= $sn; ?></td>
            <td class="output_label">Author: </td>
            <td class="output_value"><?= $publication->getAuthor(); ?></td>
        </tr>
        <tr>
            <td class="output_label">Title: </td>
            <td class="output_value"><?= $publication->getTitle(); ?></td>
        </tr>
	    <tr>
		    <td class="output_label">Publisher: </td>
		    <td class="output_value"><?= $publication->getPublisher(); ?></td>
	    </tr>
	    <tr>
		    <td class="output_label">Date Published: </td>
		    <td class="output_value"><?= $publication->getYear(); ?></td>
	    </tr>
        <tr>
            <td class="output_label" valign="top">Indexed By: </td>
            <td class="output_value">
	            <?= $publication->isScopusIndexed() ? "Scopus<br/>" : ""; ?>
	            <?= $publication->isThompsonIndexed() ? "Thompson<br/>" : ""; ?>
	            <?= !($publication->isScopusIndexed() or $publication->isThompsonIndexed()) ? "null" : ""; ?>
            </td>
        </tr>
        <tr>
            <td class="output_label" valign="top">Approval Status: </td>
            <td class="output_value"><?= $publication->getStatus(); ?></td>
        </tr>

        <tr>
            <td colspan="2" class="button_row">
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=approve&id=<?= $publication->getId(); ?>">Approve</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=ignore&id=<?= $publication->getId(); ?>">Ignore</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=pend&id=<?= $publication->getId(); ?>">Keep Pending</a> |
                <a href="?cmd=<?= $base_command; ?>&state=<?= $state; ?>&action=delete&id=<?= $publication->getId(); ?>">Delete Permanently</a>
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