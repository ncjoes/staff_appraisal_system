<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/23/2015
 * Time: 11:05 PM
 */

$request = \class_lib\Controller\RequestContext::instance();
$ranks = $request->getResponseData();
?>
<style type="text/css">
	.output_label{
		width: 40%;
	}
</style>

<input type="hidden" value="execute"/>
<table class="output_table">
	<thead>
	<th colspan="3" class="output_header1">
		<hr/>Rankings : Tutorial Staff<hr/>
	</th>
	</thead>
	<tr>
		<td class="button_row" colspan="3">
			<p class="<?= $request->getResponseStatus()==true ? "success_message" : "error_message"; ?>">
				<?= $request->getResponseError(); ?>
			</p>
			<a href="?cmd=AddTutorialStaffRank">Add Rank</a>
		</td>
	</tr>
	<?php
	$sn = 1;
	while ($rank = $ranks->next() ){
		?>
		<tr>
			<td class="output_header2" rowspan="9" valign="top"><?= $sn; ?></td>
			<td class="output_header2" colspan="2"><?= $rank->getTitle(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Title: </td>
			<td class="output_value"><?= $rank->getTitle(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. Year of Service: </td>
			<td class="output_value"><?= $rank->getMinYearOfService(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. Qualification: </td>
			<td class="output_value"><?= $rank->getMinQualification(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. No. of Publications: </td>
			<td class="output_value"><?= $rank->getMinNumOfPublications(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. No. of Supervisions: </td>
			<td class="output_value"><?= $rank->getMinNumOfSupervisions(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. Scopus Indexes: </td>
			<td class="output_value"><?= $rank->getMinScopusIndexes(); ?></td>
		</tr>
		<tr>
			<td class="output_label">Min. Thompson Indexes: </td>
			<td class="output_value"><?= $rank->getMinThompsonIndexes(); ?></td>
		</tr>

		<tr>
			<td colspan="2" class="button_row">
				<a href="?cmd=UpdateTutorialStaffRank&id=<?= $rank->getId(); ?>">Edit</a>
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