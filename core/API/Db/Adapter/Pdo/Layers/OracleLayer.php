<?php

namespace Thunderstruct\API\Db\Adapter\Pdo\Layers;

use Thunderstruct\API\Db\Adapter\Pdo\PdoInterface;
abstract class OracleLayer extends \Phalcon\Db\Adapter\Pdo\Oracle implements PdoInterface{

	public function dbExists() {}
	public function createDb() {}

}