<?php

namespace Thunderstruct\API\Adapters;

abstract class Enum {
	
	private static $cache = null ;
	protected $enum = array();
	
	public function __construct(){
		$this->enum = $this->getEnum();
	}
	
	protected function getEnum() {
		if(self::$cache == null)self::$cache = array();
		$class = get_called_class();
		if(!array_key_exists($class, self::$cache)){
			$reflect = new \ReflectionClass($class);
			self::$cache[$class] = $reflect->getConstants();
		}
		return self::$cache[$class];
	}
	
	public function isEnumValue($value){
		$values = array_values($this->enum);
		return in_array($value, $values,true);
	}
	
}