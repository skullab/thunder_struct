<?php

namespace Thunderstruct\API\Engine;

use Thunderstruct\API\Service;
use Thunderstruct\API\Engine;

class Listener{
	
	private static $_alreadyInit = false ;
	
	public function __construct(){
		if(!self::$_alreadyInit){
			self::$_alreadyInit = true ;
		}else self::throwException(null,200);
	}
	
	public function boot($event,$engine){
	}
	
	public function beforeStartModule($event,$engine){
	}
	
	public function afterStartModule($event,$engine){
		var_dump('after start module');
		
		$router = $engine->getService(Service::ROUTER);
		$moduleName = $router->getModuleName() ;
		$namespace = $router->getNamespaceName();
		$controller = ucfirst($router->getControllerName()).'Controller';
		$className = $namespace.'\\'.$controller ;
		
		$moduleClassName = $engine->getModuleDefinition($moduleName)['className'] ;
		
		if(class_exists($moduleClassName) && !is_subclass_of($moduleClassName,'Thunderstruct\API\Adapters\Module')){
			Engine::throwException($moduleName,550);
		}
		
		if(class_exists($className) && !is_subclass_of($className,'Thunderstruct\API\Mvc\Controller')){
			Engine::throwException($controller,400);
		}
	}
	
	public function beforeHandleRequest($event,$engine){
		echo '<h3>before handle</h3>';
	}
	
	public function afterHandleRequest($event,$engine){
		echo '<h3>after handle</h3>';
		
	}
}