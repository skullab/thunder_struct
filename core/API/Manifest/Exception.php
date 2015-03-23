<?php

namespace Thunderstruct\API\Manifest;
use Thunderstruct\API\Exceptions\BaseException;

class Exception extends BaseException {
	protected function defineMessages(&$messages,$extra = []) {
		$messages[100] = 'File doesn\'t exist' ;
	}
		
}