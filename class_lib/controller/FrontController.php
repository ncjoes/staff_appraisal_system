<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/9/15
 * Time: 9:47 AM
 */

namespace class_lib\controller;


use \class_lib\Command;
use \class_lib\domain;
use class_lib\Exceptions;

class FrontController {
    private function __construct() {}
    static function run() {
        $instance = new FrontController();
        $instance->init();
        $instance->handleRequest();
    }

    function init() {
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper->init();
    }

    function handleRequest() {
	    $requestContext = RequestContext::instance();
        try{
	        //recursively run commands in a dynamic array
	        function r_run($requestContext, $cmd_resolver, $start=0){
		        $cmd_chain = $requestContext->getCommandChain();
		        if(isset($cmd_chain[$start])){
			        $cmd_resolver->getCommand( $cmd_chain[$start] )->execute( $requestContext );
			        r_run($requestContext, $cmd_resolver, ++$start);
		        }
	        }

	        $cmd_resolver = new Command\CommandResolver();
	        r_run( $requestContext, $cmd_resolver);
	        domain\DomainObjectWatcher::instance()->performOperations();

        }catch (Exceptions\CommandNotFoundException $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
            //print_r($exception); exit;
        }catch (Exceptions\FormFieldNotFoundException $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
        }catch (\PDOException $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage()."<br/>".$exception->getTraceAsString());
        }catch (\Exception $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
        }
    }
}