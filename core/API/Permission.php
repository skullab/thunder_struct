<?php

namespace Thunderstruct\API;

class Permission {
	
	private $name ;
	
	public function __construct($name){
		$this->name = $name ;
	}
	
	public function getName(){
		return 'Service::'.$this->name ;
	}
	
	public function getServiceName(){
		return $this->checkService();
	}
	
	private function checkService(){
		$const = 'Thunderstruct\API\Service::'.$this->name ;
		if(defined($const)){
			return constant($const);
		}
		return null ;
	}
}