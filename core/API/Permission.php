<?php

namespace Thunderstruct\API;

class Permission {
	
	private $serviceName ;
	
	public function __construct($serviceName){
		$this->serviceName = $serviceName ;
	}
	
	public function getServiceName(){
		return $this->serviceName ;
	}
	
	public function checkService(){
		return Service::isService($this->serviceName);
	}
	
}