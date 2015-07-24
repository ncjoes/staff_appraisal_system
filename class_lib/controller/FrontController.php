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

	private function r_run(RequestContext $requestContext, $cmd_resolver, $start=0){
		//recursively run commands in a dynamic array
		$cmd_chain = $requestContext->getCommandChain();
		if(isset($cmd_chain[$start])){
			$cmd_resolver->getCommand( $cmd_chain[$start] )->execute( $requestContext );
			$this->r_run($requestContext, $cmd_resolver, ++$start);
		}
	}

    function handleRequest() {
	    $requestContext = RequestContext::instance();
        try{
	        $cmd_resolver = new Command\CommandResolver();
	        $this->r_run( $requestContext, $cmd_resolver);
	        domain\DomainObjectWatcher::instance()->performOperations();

        }catch (Exceptions\CommandNotFoundException $exception){
	        ///*
	        //development mode
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
	        //*/

	        /*
	        //deployment mode
	        $requestContext->resetCommandChain();
            $requestContext->addCommand("Default");
	        $this->handleRequest();
	        //*/

        }catch (Exceptions\FormFieldNotFoundException $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());

        }catch (\PDOException $exception){
	        /*
	        //development mode
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage()."<br/>".$exception->getTraceAsString());
	        //*/

	        ///*
	        //deployment mode
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
	        //*/

        }catch (\Exception $exception){
	        $requestContext->setResponseStatus(false);
	        $requestContext->setResponseError($exception->getMessage());
        }
    }
}