<?php

namespace Thunderstruct\API\Permission;
use Thunderstruct\API\Exceptions\BaseException;
class Exception extends BaseException{
	
	protected function defineMessages(&$messages,$extra = []){
		$messages[100] = 'The name of permissions group must be a string' ;
		$messages[200] = 'The arguments of Permission\Group constructor must be instance of Permission'; 
	}
}