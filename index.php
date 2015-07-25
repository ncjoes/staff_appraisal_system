<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 2:23 AM
 */
include_once "_system.php";

if( ! class_lib\utilities\Session::sessionExists()){header('Location:login.php');}
	autoRun(); //run commands
if( ! class_lib\utilities\Session::sessionExists()){header('Location:login.php');}

$request_context = class_lib\controller\RequestContext::instance();
$user = $request_context->getUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Staff Portal - University of Nigeria, Nsukka</title>
    <link href="views/css/styles.css" rel="stylesheet">
    <script src="views/js/forms.js" type="text/javascript"></script>
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
	        <?php
	        try{
                include("views/phtml/menu_bar/{$request_context->getMenuView()}.php");
	        }catch(\Exception $e){
		        print $e->getMessage();
	        }
	        ?>
        </td>
    </tr>

    <tr>
        <td id="sidebar_container" valign="top">
            <?php
            try{
	            include("views/phtml/side_bar/{$request_context->getSidebarView()}.php");
            }catch(\Exception $e){
	            print $e->getMessage();
            }
            ?>
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