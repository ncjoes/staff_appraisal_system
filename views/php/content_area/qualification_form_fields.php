<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/19/2015
 * Time: 9:38 AM
 */
?>
<input type="hidden" name="qualification_id" value="<?= $qualification->getId(); ?>"/>
<p class="input_row">
	<label for="title">Title: <span class="required">*</span></label>
	<input name="title" id="title" type="text" value="<?= $qualification->getTitle(); ?>" required/>
</p>
<p class="input_row">
	<label for="category">Category: <span class="required">*</span></label>
	<select name="category" id="category">
		<option value=""> </option>
		<?php
		foreach($qualification::getQualificationTypes() as $type){
			print "<option value=\"{$type}\" ".($qualification->getCategory()==$type?"selected":"")."> {$type} </option>";
		}
		?>
	</select>
</p>
<p class="input_row">
	<label for="date_m">Date Obtained: <span class="required">*</span></label>
	<select name="date_m" id="date_m">
		<option value=""> --Month-- </option>
		<script type="text/javascript">
			HtmlSelectOptions_Months("date_m", <?= $qualification->getDateObtained()->get_month(); ?>);
		</script>
	</select>
	<input name="date_d" id="date_d" type="number" min="1" max="31"
	       value="<?= $qualification->getDateObtained()->get_day(); ?>" placeholder="Day"/>
	<input name="date_y" id="date_d" type="number" min="1900" max="2100"
	       value="<?= $qualification->getDateObtained()->get_year(); ?>" placeholder="year"/>
</p>
<p class="input_row">
	<label for="institution">Awarding Institution: <span class="required">*</span></label>
	<input name="institution" id="institution" type="text"
	       value="<?= $qualification->getAwardingInstitution(); ?>" placeholder="" required/>
</p>

