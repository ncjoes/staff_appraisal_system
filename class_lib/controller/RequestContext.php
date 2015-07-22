<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:25 PM
 */

namespace class_lib\controller;

use \class_lib\domain;
use \class_lib\mapper\MapperRegistry;
use \class_lib\utilities;
use \class_lib\Exceptions;

class RequestContext {
    private $execute;
    private $request_user;
    private $request_command = array();
    private $request_data = array();
    private $request_cookies = array();
    private $request_files = array();

    private $response_status;
    private $response_data = null;
    private $response_error = null;
    private $views = array();

    private static $instance;
    static function instance(){
        if( ! isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct(){
        filter_input_array(INPUT_POST);
        filter_input_array(INPUT_GET);
        $array = array_merge($_POST, $_GET );
        $this->sanitize_input($array);
        $this->setRequestDataArray($array);
        $this->addCommand(isset( $this->request_data["cmd"]) ? $this->request_data["cmd"] : "Default" );
        $this->execute = isset($this->request_data['execute'])? true : false;
        $this->request_cookies = filter_input_array(INPUT_COOKIE);
        $this->request_files = $_FILES;
    }

    private function sanitize_input(&$array){
        if ($array !== FALSE && $array !== null) {
            foreach ($array as $key => $value) {
                if (is_array($array[$key])) {
                    $this->sanitize_input($array[$key]);
                } else {
                    $array[$key] = html_entity_decode($array[$key]);
                }
            }
        }
    }

    private function setRequestDataArray($array){
        if(!empty($array) and $array !== FALSE && $array !== null){
            $this->request_data = $array;
        }
    }

    function addCommand($command){
        $this->request_command[] = $command;
    }

    function getCommandChain(){
        return $this->request_command;
    }

    function isExecutable(){
        return $this->execute;
    }

    function fieldExists($field_name){
        if(isset($this->request_data[$field_name])){
            return $this->request_data[$field_name];
        }
        return false;
    }

    function getField($field_name){
        if(isset($this->request_data[$field_name])){
            return $this->request_data[$field_name];
        }
        throw new Exceptions\FormFieldNotFoundException("field '{$field_name}' not found in current request context");
    }

    function getAllFields(){
        return $this->request_data;
    }

    function getCookie($name){
        if(isset( $this->request_cookies[$name] )){
            return $this->request_cookies[$name];
        }
        return null;
    }
    function getCookies(){
        return $this->request_cookies;
    }

    function getFile($name){
        if(isset( $this->request_files[$name] )){
            return $this->request_files[$name];
        }
        return null;
    }
    function getFiles(){
        return $this->request_files;
    }

    function setResponseData($data){
        $this->response_data = $data;
    }
    function getResponseData(){
        return $this->response_data;
    }

    function setResponseStatus($status){
        $this->response_status = $status;
    }
    function getResponseStatus(){
        return $this->response_status;
    }

    function setResponseError($error){
        $this->response_error = $error;
    }
    function getResponseError(){
        return $this->response_error;
    }

    function setMenuView($menu_view){
        $this->views["menu"] = $menu_view;
	    return $this;
    }
    function getMenuView(){
	    if(isset($this->views["menu"])){
		    return $this->views["menu"];
	    }
	    throw new Exceptions\ViewNotSetException("Menu View not set for this request");
    }

    function setSidebarView($sidebar_view){
        $this->views["sidebar"] = $sidebar_view;
	    return $this;
    }
    function getSidebarView(){
	    if(isset($this->views["sidebar"])){
		    return $this->views["sidebar"];
	    }
	    throw new Exceptions\ViewNotSetException("Sidebar View not set for this request");
   }

    /**
     * @param $content_view
     * @return RequestContext
     */
    function addContentView($content_view){
        $this->views["content"][] = $content_view;
        return $this;
    }

    /**
     * @return array
     * @throws Exceptions\ViewNotSetException
     */
    function getContentViews(){
	    if(isset($this->views["content"])){
		    return $this->views["content"];
	    }
	    throw new Exceptions\ViewNotSetException("Content View not set for this request");
    }

    function resetContentViews(){
        $this->views["content"] = array();
        return $this;
    }
    function setUser(domain\Employee $staff){
        $this->request_user = $staff;
    }
    function getUser(){
	    if(!is_object($this->request_user)){
		    $session = utilities\Session::instance();
		    $user_obj_path = $session->getUserType();
		    $mapper = MapperRegistry::getMapper($user_obj_path);
		    $user_obj = $mapper->find($session->getUser());
		    $this->setUser($user_obj);
	    }
        return $this->request_user;
    }
}