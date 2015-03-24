<?php

namespace Thunderstruct\API;

use \Phalcon\Mvc\Application as Application;
// use \Phalcon\DI\FactoryDefault as DependencyInjection ;
use Thunderstruct\API\DI as DependencyInjection;
use Thunderstruct\API\Interfaces\Throwable;
use Thunderstruct\API\Autoloader;
use Thunderstruct\API\Manifest\Reader;
use Thunderstruct\API\Router;
use Thunderstruct\API\Manifest;
use Thunderstruct\API\Engine\Constants;
use Thunderstruct\API\Engine\Exception;

require 'Autoloader.php';
final class Engine extends Application implements Throwable {
	
	private static $_alreadyInit = false;
	private static $_instance = null;
	
	const VERSION_RELEASE = 'release';
	const VERSION_MAJOR = 'major';
	const VERSION_MINOR = 'minor';
	private static $_version = array (
			self::VERSION_RELEASE => 0,
			self::VERSION_MAJOR => 0,
			self::VERSION_MINOR => 1 
	);
	
	private $loader = null;
	private $di = null;
	private $debug;
	
	public function __construct(\Phalcon\DI $di = null) {
		if (! self::$_alreadyInit) {
			self::$_alreadyInit = true;
			self::$_instance = $this;
			
			$this->loader = new Autoloader ();
			
			new Constants ();
			
			$this->definePermissionGroups();
			
			$this->di = $di == null ? new DependencyInjection () : $di;
			
			$this->_registerServices ();
			
			parent::__construct ( $this->di );
			
			$this->_registerDefaultModule ();
			
			$this->_registerModules ();
			
			$this->_registerListener ();
			
			$this->debug = new \Phalcon\Debug ();
			
		} else
			self::throwException ( null, 100 );
	}
	public function setDI($dependencyInjector) {
	}
	public function getDI() {
	}
	protected function definePermissionGroups(){
		
		Permission\Manager::defineGroup(Service::GROUP_BASE, new Permission\Group(
				new Permission(Service::DISPATCHER),
				new Permission(Service::LOADER),
				new Permission(Service::ROUTER),
				new Permission(Service::VIEW),
				new Permission(Service::REQUEST),
				new Permission(Service::RESPONSE)
		));
		
		
	}
	protected function _registerListener() {
		$eventsManager = new \Phalcon\Events\Manager ();
		$eventsManager->attach ( 'application', new Engine\Listener () );
		$this->setEventsManager ( $eventsManager );
	}
	protected function _registerServices() {
		$loader = $this->loader;
		$dirs = $this->loader->getConfigDirs ( '../' );
		
		$this->di->set ( Service::LOADER, function () use($loader) {
			return $loader;
		}, true );
		
		$this->di->set ( Service::VIEW, function () use($dirs) {
			$view = new \Phalcon\Mvc\View ();
			$view->setViewsDir ( $dirs->ui->views );
			return $view;
		}, true );
		
		$this->di->set ( Service::URL, function () use($dirs) {
			$url = new \Phalcon\Mvc\Url ();
			$url->setBaseUri ( $dirs->base->uri );
			return $url;
		}, true );
		
		$this->di->set ( Service::ROUTER, function () {
			$router = new Router ( false );
			return $router;
		}, true );
		
		$this->di->set ( Service::DISPATCHER, function () {
			$dispatcher = new \Phalcon\Mvc\Dispatcher ();
			return $dispatcher;
		}, true );
		
		$this->di->set ( Service::VOLT, function ($view, $di) use($dirs) {
			$volt = new \Phalcon\Mvc\View\Engine\Volt ( $view, $di );
			$volt->setOptions ( array (
					"compiledPath" => $dirs->cache->volt 
			) );
			return $volt;
		}, true );
	}
	protected function _registerModuleFromManifest($dir) {
		$router = $this->di->get ( Service::ROUTER );
		$dirs = $this->loader->getConfigDirs ( '../' );
		$manifest = Reader::load ( $dirs->core->modules . $dir . '/Manifest.xml' );
		$routes = $manifest->getRoutes ();
		foreach ( $routes as $route ) {
			$router->add ( $route );
		}
		
		$moduleName = $manifest->getModuleName ();
		if($this->isRegisteredModule($moduleName))self::throwException ( $moduleName, 500 );
		
		$permissions = $manifest->getPermissions ();
		$permissionGroup = new Permission\Group() ;
		
		if ($permissions != null) {
			foreach ($permissions['groups'] as $groupName){
				$service = 'Thunderstruct\API\\'.$groupName ;
				$serviceGroup = defined($service) ? constant($service) : null ; 
				$group = Permission\Manager::getGroup($serviceGroup);
				if($group != null){
					$permissionGroup->merge($group);
				}
			}
			
			foreach ( $permissions['permissions'] as $permission ) {
				$service = 'Thunderstruct\API\\'.$permission ;
				$serviceValue = defined($service) ? constant($service) : null ;
				$permissionGroup->inflate(new Permission($serviceValue));
			}
		}
		
		foreach ($permissionGroup as $modulePermission){
			Permission\Manager::addPermission($moduleName, $modulePermission);
		}
	
		$this->registerModules ( array (
				$moduleName => array (
						'className' => ( string ) $manifest->getModuleNamespace () . '\Module',
						'path' => $dirs->core->modules . $dir . '/Module.php',
						'version' => array (
								'full' => $manifest->getVersion (),
								'release' => $manifest->getVersionInt ( 'release' ),
								'major' => $manifest->getVersionInt ( 'major' ),
								'minor' => $manifest->getVersionInt ( 'minor' )
						),
						'permissions' => $permissionGroup
				)
		), true );
		
		return $moduleName;
	}
	protected function _registerDefaultModule() {
		$moduleName = $this->_registerModuleFromManifest ( 'Test' );
		$this->setDefaultModule ( $moduleName );
	}
	protected function _registerModules() {
		// var_dump('register modules...');
		$dirs = $this->loader->getConfigDirs ( '../' );
		foreach ( scandir ( $dirs->core->modules ) as $dir ) {
			if ($dir != '.' && $dir != '..' && is_dir ( $dirs->core->modules . $dir ) && $dir != 'Test') {
				$moduleName = $this->_registerModuleFromManifest ( $dir );
				// var_dump($moduleName);
			}
		}
	}
	public static function getVersion($part = null) {
		if ($part == null) {
			return implode ( '.', self::$_version );
		} else {
			return self::$_version [$part];
		}
	}
	public static function getInstance() {
		return self::$_instance;
	}
	public function getService($name) {
		return $this->di->get ( $name );
	}
	public function debugMode($active) {
		$this->debug->listen ( $active );
	}
	public function isRegisteredModule($moduleName){
		if(trim($moduleName) == false)return false ;
		
		foreach ($this->getModules() as $name => $module){
			if($moduleName === $name)return true;
		}
		return false ;
	}
	public function getModuleDefinition($moduleName){
		return $this->getModules()[$moduleName] ;
	}
	/*
	 * (non-PHPdoc)
	 * @see \Thunderstruct\core\engine\interfaces\Throwable::throwException()
	 */
	public static function throwException($message = null, $code = null, Exception $previous = null) {
		throw new Exception ( $message, $code, $previous );
	}
}