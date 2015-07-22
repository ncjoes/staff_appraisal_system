<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/19/2015
 * Time: 9:38 AM
 */
?>
<input type="hidden" name="supervision_id" value="<?= $supervision->getId(); ?>"/>
<p class="input_row">
	<label for="project">Project Title: <span class="required">*</span></label>
	<input name="project" id="project" type="text" value="<?= $supervision->getProject(); ?>" required/>
</p>
<p class="input_row">
	<label for="year">Year: <span class="required">*</span></label>
	<input name="year" id="year" type="number" min="1900" max="2100"
	       value="<?= $supervision->getYear(); ?>" placeholder="Year"/>
</p>