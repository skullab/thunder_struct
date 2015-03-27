<?php

namespace Thunderstruct\API\Dispatcher;

class Listener {
	
	public function beforeDispatchLoop($event, $dispatcher) {
		var_dump ( 'before dispatch loop' );
	}
	public function beforeDispatch($event, $dispatcher) {
		var_dump ( 'before dispatch' );
	}
	public function beforeExecuteRoute($event, $dispatcher) {
		var_dump ( 'before execute route' );
	}
	
	public function afterExecuteRoute($event, $dispatcher) {
		var_dump ( 'after execute route' );
	}
	public function beforeNotFoundAction($event, $dispatcher) {
		var_dump ( 'before not found action' );
		//var_dump($dispatcher->getActionName());
	}
	public function beforeException($event, $dispatcher, $exception) {
		var_dump ( 'before exception' );
		
		if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
			switch ($exception->getCode()) {
				case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
				case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
					$dispatcher->forward(array(
						'controller'=> 'index',
						'action' 	=> 'error',
						'params'	=> array(404,'page not found')
					));
					return false;
			}
		}
		
		return true ;
	}
	
	public function afterDispatch($event, $dispatcher) {
		var_dump ( 'after dispatch' );
	}
	public function afterDispatchLoop($event, $dispatcher) {
		var_dump ( 'after dispatch loop' );
	}
}