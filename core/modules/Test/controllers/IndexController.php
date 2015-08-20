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
		//var_dump($this->assets->getOptions()['baseUri']);
		$this->assets->addCss('css/style.css');
		$this->flash->success("The post was correctly saved!");
	}
	
}