<?php

namespace Vendor\App;

use Thunderstruct\API\Adapters\ModuleVolt as ModuleAdapter ;
use Thunderstruct\API\Permission;
use Thunderstruct\API\Service;

class Module extends ModuleAdapter{
	
	public function initialize(){
		$group = Permission\Manager::getGroup(Service::GROUP_BASE);
		foreach ($group as $permission){
			Permission\Manager::addPermission('myModule', $permission);
		}
		Permission\Manager::addPermission('myModule', new Permission(Service::VOLT));
	}
	
	protected function afterRegisterServices($di){
		Permission\Manager::addPermission('myModule', new Permission(Service::FLASH));
		$service = $di->get('flash');
		var_dump($service);
	}
}