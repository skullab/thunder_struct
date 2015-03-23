<?php

namespace Thunderstruct\API\Engine;
use Thunderstruct\API\Exceptions\BaseException;
use Thunderstruct\API\Mvc\Controller;

class Exception extends BaseException {
	
	/** (non-PHPdoc)
	 * @see \Thunderstruct\core\engine\exceptions\BaseException::defineMessages()
	 */
	protected function defineMessages(&$messages,$extra = []) {
		$messages[100] = 'Engine is already instantiated';
		$messages[200] = 'Engine\Listener is already instantiated';
		$messages[300] = 'The module doesn\'t have permission for the service "%s"';
		$messages[400] = 'The controller "%s" MUST extend "Thunderstruct\API\Mvc\Controller"';
		$messages[500] = 'The module "%s" is already registered';
	}

}