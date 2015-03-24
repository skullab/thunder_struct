<?php

namespace Thunderstruct\API\Permission;

use Thunderstruct\API\Interfaces\Throwable;
use Thunderstruct\API\Permission;

final class Manager implements Throwable{
	
	private static $_modules = array();
	private static $_groups = array();
	private function __construct(){}
	
	public static function addPermission($moduleName,Permission $permission){
		if(!array_key_exists($moduleName, self::$_modules))self::$_modules[$moduleName] = array();
		array_push(self::$_modules[$moduleName], $permission);
	}
	
	public static function defineGroup($groupName, Group $group){
		if(!is_string($groupName)){self::throwException(null,100);}
		if(array_key_exists($groupName, self::$_groups)){self::throwException($groupName,110);}
		self::$_groups[$groupName] = $group ;
	}
	
	public static function getGroup($groupName){
		return array_key_exists($groupName, self::$_groups) ? self::$_groups[$groupName] : null ;	
	}
	
	public static function getPermissions($moduleName){
		return array_key_exists($moduleName,self::$_modules) ? self::$_modules[$moduleName] : [] ;
	}
	
	public static function checkPermission($moduleName,$serviceName){
		$permissions = self::getPermissions($moduleName);
		foreach ($permissions as $permission){
			if($permission->getServiceName() === $serviceName)return true;
		}
		return false ;
	}

	public static function throwException($message = null, $code = 0, Exception $previous = null) {
		throw new Exception($message,$code,$previous);
	}

}