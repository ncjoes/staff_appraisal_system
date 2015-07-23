<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/19/2015
 * Time: 9:38 AM
 */
?>
<input type="hidden" name="publication_id" value="<?= $publication->getId(); ?>"/>
<p class="input_row">
	<label for="title">Title: <span class="required">*</span></label>
	<input name="title" id="title" type="text" value="<?= $publication->getTitle(); ?>" required/>
</p>
<p class="input_row">
	<label for="publisher">Publisher: <span class="required">*</span></label>
	<input name="publisher" id="publisher" type="text" value="<?= $publication->getPublisher(); ?>" required/>
</p>
<p class="input_row">
	<label for="year">Publication Date: <span class="required">*</span></label>
	<input name="year" id="year" type="number" min="1900" max="2100"
	       value="<?= $publication->getYear(); ?>" placeholder="Year"/>
</p>
<p class="input_row">
	<label for="indexed_by">Indexed By: <span class="required">*</span></label>
	<span><input type="checkbox" name="indexed_by[scopus]" value="1"
			<?= $publication->isScopusIndexed() ? "checked" : ""; ?>/> Scopus</span>
	<span><input type="checkbox" name="indexed_by[thompson]" value="1"
			<?= $publication->isThompsonIndexed() ? "checked" : ""; ?>/> Thompson</span>
</p>