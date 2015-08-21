<?php

namespace Thunderstruct\API\Mvc;

abstract class Controller extends \Phalcon\Mvc\Controller {
	
	private $moduleInstance = null ;
	
	public function initialize(){
		$ref = new \ReflectionClass($this);
		$namespace = str_replace(basename($ref->getNamespaceName()),'',$ref->getNamespaceName());
		$this->moduleInstance = $this->getDI()->get($namespace.'Module');
		$this->tag->setTitle('Thunder_struct');
		$this->onInitialize();
	}
	
	protected function onInitialize(){}
	
	protected function getModule(){
		return $this->moduleInstance ;
	}
	
	public function indexAction(){}
	
	public function errorAction(){
		$args = func_get_args();
		var_dump($this->moduleInstance->getName());
		echo '<div><center><h1>'.$args[0].'</h1><span>'.$args[1].'</span></center></div>' ;
	}
	
}