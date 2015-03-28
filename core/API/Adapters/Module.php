<?php

namespace Thunderstruct\API\Adapters;

use \Phalcon\Mvc\ModuleDefinitionInterface;
use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Manifest;

abstract class Module implements ModuleDefinitionInterface {
	
	private $namespace ;
	private $baseDir ;
	private $path ;
	private $eventsManager ;
	private $loader ;
	private $dispatcher;
	private $view;
	private $configDirs ;
	private $manifest ;
	
	public function __construct(){
		
		$ref = new \ReflectionClass($this);
		$this->path = str_replace(basename($ref->getFileName()),'',$ref->getFileName());
		$this->namespace = $ref->getNamespaceName();
		$this->baseDir = basename(str_replace(basename($ref->getFileName()),'',$ref->getFileName()));
		
		$this->dispatcher = Service::get(Service::DISPATCHER);
		$this->view = Service::get(Service::VIEW);
		$this->loader = Service::get(Service::LOADER);
		
		$this->configDirs = $this->loader->getConfigDirs('../');
		$this->manifest = Manifest\Reader::load($this->path.'Manifest.xml');
		
		$this->onConstruct();
	}
	
	public function registerAutoloaders(){
		
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
	
	protected function onConstruct(){}
	protected function beforeRegisterAutoloaders($loader,$skip = true){}
	protected function onRegisterAutoloaders($loader){}
	protected function afterRegisterAutoloaders($loader){}
	
	protected function beforeRegisterServices($di,$skip = true){}
	protected function onRegisterDispatcher($dispatcher){
		$dispatcher->setDefaultNamespace($this->namespace.'\Controllers');
	}
	protected function onRegisterView($view){
		$view->setViewsDir($this->configDirs->core->modules.$this->baseDir.'/views/');
		$engines = $this->manifest->getTemplateEngines();
		
		if(!$engines)return ;
		
		$registerEngines = array();
		foreach ($engines as $engine){
			if(!isset($engine['extension']))continue;
			if(!Service::isService($engine['engine'])){
				$engine['engine'] = '\Phalcon\Mvc\View\Engine\\'.ucfirst($engine['engine']);
			}
			$registerEngines['.'.$engine['extension']] = $engine['engine'] ;
		}
		//dump($registerEngines);
		if(count($registerEngines) > 0){
			$view->registerEngines($registerEngines);
		}
	}
	protected function afterRegisterServices($di){}
	
}