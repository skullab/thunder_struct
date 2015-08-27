<?php

namespace Thunderstruct\API\Db\Adapter\Pdo\Layers;

use Thunderstruct\API\Db\Adapter\Pdo\PdoInterface;
abstract class PostgresqlLayer extends \Phalcon\Db\Adapter\Pdo\Postgresql implements PdoInterface{
	

	public function dbExists() {
		
	}
	
	
	public function createDb() {
		
	}


}