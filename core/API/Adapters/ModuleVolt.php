<?php

namespace Thunderstruct\API\Adapters;
use Thunderstruct\API\Adapters\Module;

abstract class ModuleVolt extends Module {
	
	protected function onRegisterView($view) {
		parent::onRegisterView($view);
		$view->registerEngines(array(
			'.volt'	=> 'volt', 
		));
	}

}