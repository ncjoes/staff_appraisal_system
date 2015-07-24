<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/23/2015
 * Time: 11:05 PM
 */

$requestContext = \class_lib\Controller\RequestContext::instance();
$ranks = $requestContext->getResponseData();
?>
<style type="text/css">
	.input_row label {
		width: 40%;
	}
	.button_row{
		text-align: center;
	}
</style>
<form action="?cmd=ReOrderTutorialStaffRanks" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend>Update Tutorial Staff Rank</legend>
		<p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $requestContext->getResponseError(); ?>
		</p>
	<?php
	foreach($ranks as $rank){
		?>
		<p class="input_row">
			<label for="rank_<?= $rank->getId(); ?>"><?= $rank->getTitle(); ?>: <span class="required">*</span></label>
			<input name="orders[<?= $rank->getRankID(); ?>]" id="rank_<?= $rank->getId(); ?>" type="number"
			       value="<?= $rank->getOrder(); ?>" required/>
		</p>
		<?php
	}
	?>
		<p class="button_row">
			<input type="reset" value="Reset">
			<input name="execute" value="Update Ranks Order" type="submit"/>
		</p>
	</fieldset>
</form>