<?php

namespace Thunderstruct\API\Interfaces;
interface Throwable {
	public static function throwException($message = null , $code = 0 , \Exception $previous = null);
}