<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/24/2015
 * Time: 3:30 PM
 */
?>
<input type="hidden" name="id" value="<?= $rank->getId(); ?>" />
<p class="input_row">
	<label for="rank_id">Rank ID: <span class="required">*</span></label>
	<input name="rank_id" id="rank_id" type="text" value="<?= $rank->getRankID(); ?>" required
		<?= $ctrl = $mode=="editing" ? "readonly" : ""; ?>/>
</p>
<p class="input_row">
	<label for="title">Title: <span class="required">*</span></label>
	<input name="title" id="title" type="text" value="<?= $rank->getTitle(); ?>" required spellcheck="true"/>
</p>
<p class="input_row">
	<label for="min_year_of_service">Min. Years of Service: <span class="required">*</span></label>
	<input name="min_year_of_service" id="min_year_of_service" type="number" value="<?= $rank->getMinYearOfService(); ?>" required/>
</p>
<p class="input_row">
	<label for="min_qualification">Min. Qualification: <span class="required">*</span></label>
	<select name="min_qualification" id="min_qualification">
		<option value=""> </option>
		<?php
		foreach(\class_lib\domain\Qualification::getQualificationTypes() as $q_type){
			print "<option value=\"{$q_type}\" ".($rank->getMinQualification()==$q_type?"selected":"")."> {$q_type} </option>";
		}
		?>
	</select>
</p>
<p class="input_row">
	<label for="min_num_publications">Publications: <span class="required">*</span></label>
	<input name="min_num_publications" id="min_num_publications" type="number" value="<?= $rank->getMinNumOfPublications(); ?>"
	       required title="Min. No. of Publications"/>
</p>
<p class="input_row">
	<label for="min_num_supervisions">Supervisions: <span class="required">*</span></label>
	<input name="min_num_supervisions" id="min_num_supervisions" type="number" value="<?= $rank->getMinNumOfSupervisions(); ?>"
	       required title="Min. No. of Supervisions"/>
</p>
<p class="input_row">
	<label for="min_num_scopus_indexes">Min. Scopus Indexes: <span class="required">*</span></label>
	<input name="min_num_scopus_indexes" id="min_num_scopus_indexes" type="number" value="<?= $rank->getMinScopusIndexes(); ?>" required/>
</p>
<p class="input_row">
	<label for="min_num_thompson_indexes">Min. Thompson Indexes: <span class="required">*</span></label>
	<input name="min_num_thompson_indexes" id="min_num_thompson_indexes" type="number" value="<?= $rank->getMinThompsonIndexes(); ?>" required/>
</p>