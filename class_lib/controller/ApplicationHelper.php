<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/15/2015
 * Time: 8:32 PM
 */

namespace class_lib\controller;


class ApplicationHelper
{
    private static $instance;
    private function __construct(){}

    static function instance(){
        if(!isset(ApplicationHelper::$instance)){
            ApplicationHelper::$instance = new ApplicationHelper();
        }
        return ApplicationHelper::$instance;
    }

    //initialize Application
    function init(){

    }
}