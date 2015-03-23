<?php

namespace Thunderstruct\API\Mvc;

abstract class Controller extends \Phalcon\Mvc\Controller {
	
	public function setDI($dependencyInjector){}
	public function getDI(){}
	
}