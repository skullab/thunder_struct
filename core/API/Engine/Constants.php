<?php

namespace Thunderstruct\API\Engine;

use Thunderstruct\API\Engine;
use Thunderstruct\API\Tokenizer;

final class Constants {
	
	private static $_alreadyInit = false ;
	
	public function __construct(){
		if(self::$_alreadyInit)return;
		
		define('THUNDERSTRUCT','thunderstruct');
		define('TS',THUNDERSTRUCT);
		define('TS_VERSION',Engine::getVersion());
		define('TS_PREFIX','ts');
		define('TS_DB_PREFIX',Engine::getInstance()->getDbPrefix().'_');
		
		self::$_alreadyInit = true;
	}
	
}