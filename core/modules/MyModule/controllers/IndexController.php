<?php

namespace Vendor\App\Controllers;

use Thunderstruct\API\Mvc\Controller;
use Thunderstruct\API\Service;

class IndexController extends Controller {

	public function indexAction(){
		$this->assets->addCss('css/style.css');
	}
}