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
$publications = $staff->get_publications();
$base_command = "ListPublications";
?>
<input type="hidden" value="execute"/>
<table class="output_table">
    <thead>
    <th colspan="3" class="output_header1">
        <hr/><?= $staff->get_lastname().", ".$staff->get_firstname()." ".$staff->get_othernames() ?> : Publications<hr/>
    </th>
    </thead>
    <tr>
        <td class="button_row" colspan="3">
	        <p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
		        <?= $context->getResponseError(); ?>
	        </p>
	        <a href="?cmd=AddPublication">Add Publication</a>
        </td>
    </tr>
    <?php
    $sn = 1;
    while ($publication = $publications->next() ){
        ?>
        <tr>
            <td class="output_header2" rowspan="7" valign="top"><?= $sn; ?></td>
            <td class="output_header2" colspan="2"><?= $publication->getTitle(); ?></td>
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
                <a href="?cmd=<?= $base_command; ?>&action=Edit&publication_id=<?= $publication->getId(); ?>">Edit</a>
                |
                <?php
                if($publication->getStatus()=="Deleted"){
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=undoDelete&publication_id=<?= $publication->getId(); ?>">Undo Delete</a>
                    <?php
                }else{
                    ?>
                    <a href="?cmd=<?= $base_command; ?>&action=Delete&publication_id=<?= $publication->getId(); ?>">Delete</a>
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