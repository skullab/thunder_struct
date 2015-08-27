<?php

namespace Thunderstruct\Modules\Installer\Controllers;
use Thunderstruct\API\Mvc\Controller;

class IndexController extends Controller {
	
	public function indexAction(){
		echo 'install' ;
	}
	
	public function successAction(){
		$this->flash->success ( "Installation success !" );
	}
}