<?php

namespace Thunderstruct\API\Db\Adapter\Pdo;

interface  PdoInterface {
	public function dbExists();
	public function createDb();
}