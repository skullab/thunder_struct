<?php

namespace Thunderstruct\API\Service;
use Thunderstruct\API\Exceptions\BaseException;

class Exception extends BaseException {
	
	protected function defineMessages(&$messages,$extra = []){
		$messages[200] = 'Service "%s" not found';
	}
}