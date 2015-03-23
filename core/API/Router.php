<?php

namespace Thunderstruct\API;

class Router extends \Phalcon\Mvc\Router {
	
	public function getDI(){}
	
	/* @overloading */
	public function add($pattern,$paths = null ,$httpMethods = null){
		$_route = $pattern ;
		$name = null ;
		if($_route instanceof \Phalcon\Mvc\Router\Route){
			$pattern = $_route->getPattern();
			$paths = $_route->getPaths();
			$httpMethods = $_route->getHttpMethods();
			$name = $_route->getName();
		}
		if($httpMethods != null && $name != null){
			return parent::add($pattern,$paths)->via($httpMethods)->setName($name);
		}elseif($httpMethods != null){
			return parent::add($pattern,$paths)->via($httpMethods);
		}elseif($name != null){
			return parent::add($pattern,$paths)->setName($name);
		}else{
			return parent::add($pattern,$paths);
		}
	}
}