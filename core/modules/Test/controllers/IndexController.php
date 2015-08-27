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
		
		/*$this->assets->requireJQuery ();
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
			$this->db->createDb();
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
		}else{
			$sql     = "INSERT INTO `ts_users`(name, password) VALUES (:name, :password)";
			$success = $this->db->query($sql, array("name" => "foo", "password" => "1234"));
		
			$sql = "SELECT * FROM ts_users";
			
			// Send a SQL statement to the database system
			$result = $this->db->query($sql);
			
			// Print each robot name
			while ($user = $result->fetch()) {
				var_dump($user["id"]);
				var_dump($user["name"]);
				var_dump($user["password"]);
				var_dump("----------");
			}
				
		}*/
		
		echo 'FRONTEND' ;
	}
}