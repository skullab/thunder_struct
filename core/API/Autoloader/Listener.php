<?php

namespace Thunderstruct\API\Autoloader;

class Listener {
	public function beforeCheckClass($event,$loader){
		var_dump('loader : beforeCheckClass');
	}
	public function pathFound($event,$loader){
		var_dump('loader : pathFound');
	}
	public function afterCheckClass($event,$loader){
		var_dump('loader : afterCheckClass');
	}
}