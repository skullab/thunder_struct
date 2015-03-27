<?php

namespace Thunderstruct\API\Adapters\Module;
use Thunderstruct\API\Adapters\Module;

class Volt extends Module{
	
	protected function onRegisterView($view) {
		parent::onRegisterView($view);
		$view->registerEngines(array(
				'.volt'	=> 'volt',
		));
	}
}