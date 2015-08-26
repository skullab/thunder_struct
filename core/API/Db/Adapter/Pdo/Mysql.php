<?php

namespace Thunderstruct\API\Db\Adapter\Pdo;

class Mysql extends \Phalcon\Db\Adapter\Pdo\Mysql {
	
	private $dbExists = true;
	private $m_descriptor;
	private $m_host_info;
	public function __construct(array $descriptor) {
		try {
			$this->m_descriptor = $descriptor;
			parent::__construct ( $descriptor );
		} catch ( \Exception $e ) {
			if ($e->getCode () == 1049) {
				$this->dbExists = false;
			}
		}
	}
	public function dbExists() {
		return $this->dbExists;
	}
	public function createThisDb() {
		if (! $this->dbExists) {
			$mysqli = new \mysqli ( 
					$this->m_descriptor ['host'], 
					$this->m_descriptor ['username'], 
					$this->m_descriptor ['password'] );
			
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
			}
			
			$this->m_host_info = $mysqli->host_info ;
			
			$sql = 'CREATE DATABASE IF NOT EXISTS '.$this->m_descriptor['dbname'] ;
			
			if(!$mysqli->query($sql)){
				$mysqli->close();
				die("DB creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}
			
			$mysqli->close();
			$this->dbExists = true ;
			
			parent::__construct ( $this->m_descriptor );
		}
	}
}