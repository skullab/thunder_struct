<?php

namespace Thunderstruct\API\Mvc;

abstract class Controller extends \Phalcon\Mvc\Controller {
	
	private $moduleInstance = null ;
	
	public function initialize(){
		$ref = new \ReflectionClass($this);
		$namespace = str_replace(basename($ref->getNamespaceName()),'',$ref->getNamespaceName());
		$this->moduleInstance = $this->getDI()->get($namespace.'Module');
		$this->onInitialize();
	}
	
	protected function onInitialize(){}
	
	protected function getModule(){
		return $this->moduleInstance ;
	}
}