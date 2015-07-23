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
	<img src="views/img/dashboard.jpg" alt="Dashboard" align="middle"/>
</div>
<hr/>
<div class="side_bar_links_container">
	<span class="link_group_label">Control Panel &hellip;</span>
	<ul class="side_bar_links">
		<li><a href="?cmd=AdminDashboard"> Dashboard </a></li>
	</ul>
</div>
<div class="side_bar_links_container">
	<span class="link_group_label">Update Reviews &hellip;</span>
	<ul class="side_bar_links">
		<li><a href="?cmd=ReviewQualifications"> Qualifications </a></li>
		<li><a href="?cmd=ReviewPublications"> Publications </a></li>
		<li><a href="?cmd=ReviewSupervisions"> Supervisions </a></li>
	</ul>
</div>

