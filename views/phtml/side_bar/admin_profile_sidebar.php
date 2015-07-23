<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/20/2015
 * Time: 2:18 AM
 */
$context = \class_lib\controller\RequestContext::instance();
$user = $context->getUser();
?>
<div class="passport_photo">
	<img src="views/img/staff_photos/no_photo.jpg" alt="no passport photograph" align="middle"/>
</div>
<hr/>
<div class="side_bar_links_container">
                <span class="link_group_label">
                <?= $user->getShortName(); ?>
                </span>
	<ul class="side_bar_links">
		<li><a href="?cmd=AdminProfileDetails"> View Profile Details </a></li>
	</ul>
</div>
<div class="side_bar_links_container">
	<span class="link_group_label">Update Profile &hellip;</span>
	<ul class="side_bar_links">
		<li><a href="?cmd=UpdatePersonalData"> Personal Data </a></li>
		<li><a href="?cmd=ListQualifications"> Qualifications </a></li>
		<li><a href="?cmd=UpdateBiography"> About Me </a></li>
	</ul>
</div>
<div class="side_bar_links_container">
	<span class="link_group_label">Account Settings &hellip;</span>
	<ul class="side_bar_links">
		<li><a href="?cmd=ChangePassword"> Change Password </a></li>
	</ul>
</div>