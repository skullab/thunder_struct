<?php

namespace Thunderstruct\API\Mvc;

abstract class Model extends \Phalcon\Mvc\Model{
	
	public function initialize(){
		
		$this->onInitialize();
	}
	
	protected function onInitialize(){}
}