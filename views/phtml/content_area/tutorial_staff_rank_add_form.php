<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/24/2015
 * Time: 3:27 PM
 */

$context = \class_lib\controller\RequestContext::instance();
$rank = $context->getResponseData();
?>
<form action="?cmd=AddTutorialStaffRank" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend>Add Tutorial Staff Rank</legend>
		<p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $context->getResponseError(); ?>
		</p>
		<?php $mode = "new"; include("tutorial_staff_rank_form_fields.php"); ?>
		<p class="button_row">
			<a href="?cmd=ListTutorialStaffRanks">back to list</a>&nbsp;|&nbsp;
			<input name="execute" value="Add Tutorial Staff Rank" type="submit"/>
		</p>
	</fieldset>
</form>