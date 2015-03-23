<?php

namespace Thunderstruct\API ;
use  \Phalcon\Loader as Loader ;
use \Phalcon\Config\Adapter\Ini as Config;
use Thunderstruct\API\Interfaces\Throwable ;
use Thunderstruct\API\Autoloader\Exception ;
use Thunderstruct\API\Autoloader\Listener;

require 'Interfaces/Throwable.php';

final class Autoloader extends Loader implements Throwable{
	private static $_alreadyInit = false ;
	
	private $config = null ;
	
	public function __construct(){
		if(!self::$_alreadyInit){
			self::$_alreadyInit = true ;
			parent::__construct();
			$this->registerConfiguration();
			$this->registerDefaultDirs();
			$this->registerDefaultNamespaces();
			$this->registerListener();
		}else self::throwException(null,100);
	}
	
	private function registerListener(){
		$eventsManager = new \Phalcon\Events\Manager();
		$eventsManager->attach('loader', new Listener());
		$this->setEventsManager($eventsManager);
	}
	
	private function registerConfiguration(){
		$backDir = '/../' ;
		$this->config = array();
		$this->config['app'] = new Config($backDir.'config/app.ini.php');
		$this->config['db'] = new Config($backDir.'config/db.ini.php');
		$this->config['dir'] = new Config($backDir.'config/dir.ini.php');
		//var_dump($this->config);
	}
	
	private function registerDefaultDirs(){
		$backDir = '../' ;
		$this->registerDirs(array(
				$backDir.$this->config['dir']->core->modules,
				$backDir.$this->config['dir']->core->cache,
				$backDir.$this->config['dir']->core->logs,
				$backDir.$this->config['dir']->core->plugins
		),true)->register();
		//var_dump($this->getDirs());
	}
	private function registerDefaultNamespaces(){
		$backDir = '../' ;
		$this->registerNamespaces(array(
				'Thunderstruct\API' 	=> $backDir.$this->config['app']->API->base,
				'Thunderstruct\Modules'	=> $backDir.$this->config['dir']->core->modules,
		),true)->register();
		//var_dump($this->getNamespaces());
	}	
	public function getConfigDirs($basePath = null){
		$backDir = '/../' ;
		$dirs = new Config($backDir.'config/dir.ini.php');
		if($basePath == null)return $dirs;
		foreach ($dirs as $set => $obj){
			if($set != 'base' && $set != 'public')
			foreach ($dirs[$set] as $key => $value){
				$dirs[$set][$key] = $basePath.$value;
			}
		}
		return $dirs ;
	}
	
	/* (non-PHPdoc)
	 * @see \Thunderstruct\core\engine\interfaces\Throwable::throwException()
	 */
	public static function throwException($message = null, $code = 0, Exception $previous = null) {
		throw new Exception($message,$code,$previous);
	}

}
