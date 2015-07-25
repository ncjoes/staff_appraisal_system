<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 2:23 AM
 */

require_once "_system.php";

if(class_lib\utilities\Session::sessionExists()){header('Location:index.php');}
    autoRun(); //run commands
if(class_lib\utilities\Session::sessionExists()){header('Location:index.php');}

$request_context = class_lib\controller\RequestContext::instance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login: Staff Portal - University of Nigeria, Nsukka</title>
    <link href="views/css/styles.css" rel="stylesheet">
</head>
<body>
<table id="main_container" align="center" cellpadding="0" cellspacing="0">

    <tr>
        <td id="site_name_container">
            <ul class="site_name">
                <li>STAFF APPRAISAL SYSTEM<br/>&hellip;</li>
            </ul>
        </td>
        <td id="menu_container">
            <ul class="menuBar">
                <li><a href="?cmd=Default"> ABOUT </a></li>
            </ul>
            <ul class="right_button">
                <li class="right_button"><a href="?">&hellip;</li>
            </ul>
        </td>
    </tr>

    <tr>
        <td id="banner_container" colspan="2">
            Logo; Banner
            <br/><br/><br/><br/><br/><br/><br/><br/>
        </td>
    </tr>
    <tr>
        <td id="sidebar_container" valign="top">
            <div class="side_bar_links_container">
                <span class="link_group_label">Sign in as &hellip;</span>
                <ul class="side_bar_links">
                    <li><a href="?cmd=StaffLogin"> Staff </a></li>
                    <li><a href="?cmd=AdminLogin"> Admin </a></li>
                </ul>
            </div>
        </td>
        <td id="content_container" valign="top">
	        <?php
	        try{
		        foreach($request_context->getContentViews() as $view){
			        include("views/phtml/content_area/{$view}.php");
		        }
	        }catch(\Exception $e){
		        print $request_context->getResponseError();
		        print "<br/>";
		        print $e->getMessage();
	        }
	        ?>
        </td>
    </tr>

    <tr>
        <td id="footer_container" colspan="2">
            Staff Appraisal System. &copy; 2015 {name}
        </td>
    </tr>

</table>
</body>
</html>