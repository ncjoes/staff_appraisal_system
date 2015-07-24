<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/24/2015
 * Time: 5:01 PM
 */

$context = \class_lib\controller\RequestContext::instance();
$rank = $context->getResponseData();
?>
<form action="?cmd=UpdateTutorialStaffRank" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend>Update Tutorial Staff Rank</legend>
		<p class="<?= $context->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $context->getResponseError(); ?>
		</p>
		<?php $mode = "editing"; include("tutorial_staff_rank_form_fields.php"); ?>
		<p class="button_row">
			<a href="?cmd=ListTutorialStaffRanks">back to list</a>&nbsp;|&nbsp;
			<input name="execute" value="Update Rank" type="submit"/>
		</p>
	</fieldset>
</form>