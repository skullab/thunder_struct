<?php

namespace Thunderstruct\API\Permission;

use Thunderstruct\API\Permission;
use Thunderstruct\API\Interfaces\Throwable;

class Group implements \Iterator , Throwable{
	
	private $group = array();
	
	public function __construct(){
		$args = func_get_args();
		foreach ($args as $permission){
			if(!$permission instanceof Permission){self::throwException(null,200);}
			array_push($this->group, $permission);
		}
	}
	/* (non-PHPdoc)
	 * @see Iterator::current()
	 */
	public function current() {
		return current($this->group);
	}

	/* (non-PHPdoc)
	 * @see Iterator::key()
	 */
	public function key() {
		return key($this->group);
	}
	
	/* (non-PHPdoc)
	 * @see Iterator::next()
	 */
	public function next() {
		return next($this->group);
	}
	
	/* (non-PHPdoc)
	 * @see Iterator::rewind()
	 */
	public function rewind() {
		return reset($this->group);
	}
	
	/* (non-PHPdoc)
	 * @see Iterator::valid()
	 */
	public function valid() {
		$key = $this->key();
		return ($key !== NULL && $key !== FALSE);
	}


	/* (non-PHPdoc)
	 * @see \Thunderstruct\API\Interfaces\Throwable::throwException()
	 */
	public static function throwException($message = null, $code = 0, Exception $previous = null) {
		throw new Exception($message,$code,$previous);
	}

}