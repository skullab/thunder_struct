<?php

namespace Thunderstruct\Modules\Test\Controllers;

use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Mvc\Controller;
use Thunderstruct\API\Debug\Log;
use Thunderstruct\API\Tokenizer;
use Thunderstruct\API\Autoloader;

class IndexController extends Controller{
	
	
	public function indexAction(){
		$config = new \Phalcon\Config\Adapter\Ini('../core/config/db.ini.php');
		var_dump($config);
	}
	
	public function otherAction(){
		$this->flash->notice('other of default');
	}
	
}