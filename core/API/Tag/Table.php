<?php

namespace Thunderstruct\API\Tag;

use Thunderstruct\API\Tag;
use Thunderstruct\API\Mvc\Model\Resultset;

class Table extends Tag{
	
	/**
	 * Generate HTML Table by Model ResultSet
	 * @param Model $model
	 */
	static public function generate(Resultset $resultset){
		$code = '<table>' ;
		foreach ($resultset as $record){
			$code .= '<tr>' ;
			foreach ($record->toArray() as $value){
				$code .= '<td>'.$value.'</td>' ;
			}
			$code .= '</tr>' ;
		}
		$code .= '</table>';
		
		return $code ;
	}
}