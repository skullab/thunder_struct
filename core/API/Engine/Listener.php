<?php

namespace Thunderstruct\API\Engine;

use Thunderstruct\API\Service;
use Thunderstruct\API\Interfaces\Throwable;
use Thunderstruct\API\Engine;

class Listener implements Throwable {
	
	private static $_alreadyInit = false ;
	
	public function __construct(){
		if(!self::$_alreadyInit){
			self::$_alreadyInit = true ;
		}else self::throwException(null,200);
	}
	
	public function boot($event,$engine){
		//var_dump('boot');
		//var_dump($engine);
	}
	
	public function beforeStartModule($event,$engine){
		/*$dispatcher = $engine->getService(Service::DISPATCHER) ;
		$router = $engine->getService(Service::ROUTER);
		$moduleName = $router->getModuleName() ;
		$namespace = $router->getNamespaceName();
		$controller = ucfirst($router->getControllerName()).'Controller';
		$className = $namespace.'\\'.$controller ;*/
		
		//var_dump('before start module : '.$moduleName.' - '.$className);
		//var_dump('module class name exist ? '.(int)class_exists($className));
	}
	
	public function afterStartModule($event,$engine){
		//var_dump('after start module');
		$dispatcher = $engine->getService(Service::DISPATCHER) ;
		$router = $engine->getService(Service::ROUTER);
		$moduleName = $router->getModuleName() ;
		$namespace = $router->getNamespaceName();
		$controller = ucfirst($router->getControllerName()).'Controller';
		$className = $namespace.'\\'.$controller ;
		
		if(class_exists($className) && !is_subclass_of($className,'Thunderstruct\API\Mvc\Controller')){
			Engine::throwException($controller,400);
		}
	}
	
	public function beforeHandleRequest($event,$engine){
		//var_dump('before handle request');
		//Service::get(Service::LOADER)->eFIles();
		echo '<h3>before handle</h3>';
	}
	
	public function afterHandleRequest($event,$engine){
		//var_dump('after handle request');
		//Service::get(Service::LOADER)->rFIles();
		echo '<h3>after handle</h3>';
	}
	
	public static function throwException($message = null, $code = 0, Exception $previous = null) {
		throw new Exception($message,$code,$previous);
	}

}