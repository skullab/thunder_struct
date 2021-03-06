<?php

namespace Thunderstruct\Modules\Test\Controllers;

use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Mvc\Controller;
use Thunderstruct\API\Debug\Log;
use Thunderstruct\API\Tokenizer;
use Thunderstruct\API\Autoloader;

use Thunderstruct\Modules\Test\Models\Users;
use Thunderstruct\API\Mvc\Model\Resultset;

class IndexController extends Controller {
	
	const USER_CREATE = 'create' ;
	const USER_DELETE = 'delete' ;
	const USER_UPDATE = 'update' ;
	const USER_LOAD   = 'load' ;
			
	public function indexAction() {
		
		$this->assets->requireJQueryUI();
		$this->assets->requireJQuery();
		$this->assets->requireCustomCss('jtable/2.4.0/themes/metro/blue/jtable.min.css',true,false);
		$this->assets->requireCustomJs('jtable/2.4.0/jquery.jtable.js',true,false);
		$this->assets->requireCustomJs('jtable/2.4.0/localization/jquery.jtable.it.js',true,false);
		$this->assets->requireJs('js/test.js');
		
	}
		
	public function usersAction(){
		
		$method = $this->dispatcher->getParam('method');
		
		switch ($method){
			case self::USER_LOAD:
				return $this->loadUsers();
			case self::USER_CREATE:
				return $this->createUser();
			case self::USER_DELETE:
				return $this->deleteUser();
			case self::USER_UPDATE:
				return $this->updateUser();
		}
	}
	
	private function loadUsers(){
		$method = $this->dispatcher->getParam('method');
		var_dump($method);
		$filter = @$_POST['name'];
		$users = Users::find(array(
				"name LIKE '%$filter%'",
				'order'	=> $_GET['jtSorting'],
				'limit'	=> array('number' => $_GET['jtPageSize'] , 'offset' => $_GET['jtStartIndex'])
				
		));
		$table = $users->toArray();
		$count = Users::count();
		$payload = array('Result'=>'OK','Records'=>$table,'TotalRecordCount'=>$count);
		
		return $this->ajax($payload);
	}
	
	private function createUser(){
		$user = new Users();
		$user->create($_POST);
		$last = Users::find();
		$payload = array('Result' => 'OK','Record'=>$last->getLast()->toArray());

		return $this->ajax($payload);
	}
	
	private function deleteUser(){
		$user = Users::find(array('id = '.@$_POST['id']));
		if(count($user) == 1){
			$user->delete();
		}
		$payload = array('Result'=>'OK');
		return $this->ajax($payload);
	}
	
	private function updateUser(){
		$user = new Users();
		$user->save($_POST);
		$payload = array('Result'=>'OK');
		return $this->ajax($payload);
	}
}