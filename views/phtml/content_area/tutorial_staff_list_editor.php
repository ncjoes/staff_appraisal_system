<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/25/2015
 * Time: 12:37 PM
 */

$requestContext = \class_lib\Controller\RequestContext::instance();
$employees = $requestContext->getResponseData();
?>

<input type="hidden" value="execute"/>
<table class="output_table">
	<thead>
	<th colspan="6" class="output_header1">
		<hr/>Employees : Tutorial Staff
		<p class="<?= $requestContext->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
			<?= $requestContext->getResponseError(); ?>
		</p>
		<hr/>
	</th>
	</thead>
	<tr>
		<td class="output_header2">SN</td>
		<td class="output_header2">EID</td>
		<td class="output_header2">LASTNAME</td>
		<td class="output_header2">FIRSTNAME</td>
		<td class="output_header2">OTHERNAMES</td>
		<td class="output_header2">RANK</td>
	</tr>
	<tr>
		<td colspan="6">    <hr/></td>
	</tr>
	<?php
	$sn = 1;
	while ($staff = $employees->next() ){
		?>
		<tr>
			<td class="output_value"><?= $sn; ?></td>
			<td class="output_value"><?= $staff->get_employeeId(); ?></td>
			<td class="output_value"><?= $staff->get_lastname(); ?></td>
			<td class="output_value"><?= $staff->get_firstname(); ?></td>
			<td class="output_value"><?= $staff->get_othernames(); ?></td>
			<td class="output_value"><?= $staff->getRank()->getTitle(); ?></td>
		</tr>
		<?php
		$sn++;
	}
	?>
	<tr>
		<td colspan="6"><hr/></td>
	</tr>
	<tr>
		<td class="button_row" colspan="6">
			<a href="?cmd=AddTutorialStaff">Add Tutorial Staff</a>
		</td>
	</tr>
</table>