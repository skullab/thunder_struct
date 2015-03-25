<?php

namespace Thunderstruct\API\Adapters;

use \Phalcon\Mvc\ModuleDefinitionInterface;
use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;

abstract class Module implements ModuleDefinitionInterface {
	
	private $namespace ;
	private $baseDir ;
	private $path ;
	private $eventsManager ;
	private $loader ;
	private $dispatcher;
	private $view;
	private $configDirs ;
	
	public function __construct(){
		//var_dump('call module constructor');
		
		$ref = new \ReflectionClass($this);
		$this->path = str_replace(basename($ref->getFileName()),'',$ref->getFileName());
		$this->namespace = $ref->getNamespaceName();
		$this->baseDir = basename(str_replace(basename($ref->getFileName()),'',$ref->getFileName()));
		
		$this->dispatcher = Engine::getInstance()->getService(Service::DISPATCHER);
		$this->view = Engine::getInstance()->getService(Service::VIEW);
		$this->loader = Engine::getInstance()->getService(Service::LOADER);
		$this->configDirs = $this->loader->getConfigDirs('../');
		
		$this->initialize();
		
	}
	
	public function registerAutoloaders(){
		//var_dump('call module registerAutoloaders');
		
		$skip = $this->beforeRegisterAutoloaders($this->loader);
		if($skip === true)return;
		
		$this->loader->registerNamespaces(array(
			$this->namespace.'\Controllers' => $this->configDirs->core->modules.$this->baseDir.'/controllers/',
			$this->namespace.'\Models'		=> $this->configDirs->core->modules.$this->baseDir.'/models/', 
		),true);
		
		$this->onRegisterAutoloaders($this->loader);
		
		$this->loader->register();
		
		$this->afterRegisterAutoloaders($this->loader);
	}
	
	public function registerServices($di){
		//var_dump('call module registerServices ');
		
		$skip = $this->beforeRegisterServices($di);
		if($skip === true)return;
		
		$this->onRegisterDispatcher($this->dispatcher);
		$this->onRegisterView($this->view);
		
		$this->afterRegisterServices($di);
	}
	
	protected function getLoader(){
		return $this->loader ;
	}
	protected function getConfigDirs(){
		return $this->configDirs ;
	}
	protected function setEventsManager($eventsManager){
		$this->eventsManager = $eventsManager ;
	}
	protected function getEventsManager(){
		return $this->eventsManager;
	}
	
	protected function initialize(){}
	protected function beforeRegisterAutoloaders($loader,$skip = true){}
	protected function onRegisterAutoloaders($loader){}
	protected function afterRegisterAutoloaders($loader){}
	
	protected function beforeRegisterServices($di,$skip = true){}
	protected function onRegisterDispatcher($dispatcher){
		$dispatcher->setDefaultNamespace($this->namespace.'\Controllers');
	}
	protected function onRegisterView($view){
		$view->setViewsDir($this->configDirs->core->modules.$this->baseDir.'/views/');
	}
	protected function afterRegisterServices($di){}
	
}