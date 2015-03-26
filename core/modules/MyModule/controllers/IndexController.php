<?php

namespace Vendor\App\Controllers;

use Thunderstruct\API\Mvc\Controller;

class IndexController extends Controller {
	public function indexAction() {
		
	}
	public function otherAction() {
		$this->flash->notice('other action of mymodule');
	}
}