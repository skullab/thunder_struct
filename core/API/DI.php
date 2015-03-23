<?php

namespace Thunderstruct\API;

class DI extends \Phalcon\DI\FactoryDefault {
	
	private $router;
	private $_init = false;
	public function __construct() {
		parent::__construct ();
	}
	
	public function get($name, $parameters = []) {
		if ($this->router == null) {
			$this->router = $this->getShared ( 'router' );
			$this->_init = true;
		}
		return parent::get ( $name, $parameters );
	}
	
	public function getShared($name, $parameters = null) {
		if ($this->_init) {
			$moduleName = $this->router->getModuleName ();
			$permission = Permission\Manager::checkPermission ( $moduleName, $name );
			$className = $this->router->getNamespaceName ();
			
			//var_dump ( 'module ' . $moduleName . ' wanna get shared ' . $name );
			if (! $permission && $moduleName != null && strpos ( $name, $className ) === false){
				//var_dump ( 'doesn\'t have permission for ' . $name . ' ' . $moduleName . ' ' . ( int ) $permission );
				Engine::throwException($name,300);
			}
		}
		return parent::getShared ( $name, $parameters );
	}
}