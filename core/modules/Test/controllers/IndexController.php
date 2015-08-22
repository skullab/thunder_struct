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
		//$this->assets->addStandardCss('css/style.css');
		//$this->assets->addJs('js/ops.js');
		//$this->assets->requireStandardJs('js/ops.js');
		
		//$this->assets->requireStandardCss('css/style.css');
		//$this->assets->requireCss('css/style.css');
		//$this->assets->addStandardCss('css/ops.css');
		$this->assets->requireJQuery();
		$this->assets->requireJQueryCDN('1.11.2');
		$this->assets->requireJQuery('1.11.3');
		$this->assets->requireJQuery('1.11.3');
		$this->assets->requireJQuery('1.11.4.min');
		$this->flash->success("The post was correctly saved!");
		
		$this->view->headerHooks = 'header hooks' ;
		$this->view->footerHooks = 'footer hooks' ;
	}
	
}