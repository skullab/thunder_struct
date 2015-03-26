<?php
namespace Thunderstruct\API\Autoloader;
use Thunderstruct\API\Exceptions\BaseException;

class Exception extends BaseException{
	
	/* (non-PHPdoc)
	 * @see \Thunderstruct\core\engine\exceptions\BaseException::defineMessages()
	 */
	protected function defineMessages(&$messages,$extra = []) {
		$messages[100] = 'Autoloader is already instantiated';
		$messages[200] = 'Secure hash is incorrect' ;
	}

}