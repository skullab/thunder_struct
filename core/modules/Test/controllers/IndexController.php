<?php

namespace Thunderstruct\Modules\Test\Controllers;

use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Mvc\Controller;
use Thunderstruct\API\Debug\Log;
use Thunderstruct\API\Tokenizer;
use Thunderstruct\API\Autoloader;
use \Phalcon\Db\Column as Column;

class IndexController extends Controller {
	public function indexAction() {
		// var_dump($this->assets->getOptions()['baseUri']);
		// $this->assets->addStandardCss('css/style.css');
		// $this->assets->addJs('js/ops.js');
		// $this->assets->requireStandardJs('js/ops.js');
		
		// $this->assets->requireStandardCss('css/style.css');
		// $this->assets->requireCss('css/style.css');
		// $this->assets->addStandardCss('css/ops.css');
		$this->assets->requireJQuery ();
		$this->assets->requireJQueryCDN ( '1.11.2' );
		$this->assets->requireJQuery ( '1.11.3' );
		$this->assets->requireJQuery ( '1.11.3' );
		$this->assets->requireJQuery ( '1.11.4.min' );
		$this->assets->requireJs ( 'js/pippo.js' );
		$this->flash->success ( "The post was correctly saved!" );
		
		$this->view->headerHooks = 'header hooks';
		$this->view->footerHooks = 'footer hooks';
		
		//$this->db->createThisDb();
		
		if(!$this->db->dbExists()){
			var_dump('no db');
			$this->db->createThisDb();
		}
		
		if (! $this->db->tableExists ( TS_DB_PREFIX . 'users' )) {
			var_dump ( 'create users table' );
			
			$this->db->createTable ( TS_DB_PREFIX . "users", null, array (
					"columns" => array (
							new Column ( "id", array (
									"type" => Column::TYPE_INTEGER,
									"size" => 10,
									"notNull" => true,
									"autoIncrement" => true,
									"primary" => true
							) ),
							new Column ( "name", array (
									"type" => Column::TYPE_VARCHAR,
									"size" => 70,
									"notNull" => true 
							) ),
							new Column ( "password", array (
									"type" => Column::TYPE_VARCHAR,
									"size" => 70,
									"notNull" => true 
							) ) 
					) 
			) );
		}
	}
}