<?php
namespace Thunderstruct\API;
use Thunderstruct\API\Adapters\Enum;
use Thunderstruct\API\Interfaces\Throwable;
use Thunderstruct\API\Engine;
use Thunderstruct\API\Service\Exception;

class Service extends Enum implements Throwable{
	
	const LOADER				= 'loader' ;
	const VIEW					= 'view' ;
	const URL					= 'url' ;
	const ROUTER				= 'router' ;
	const DISPATCHER			= 'dispatcher' ;
	const VOLT					= 'volt' ;
	const SESSION				= 'session' ;
	const REQUEST				= 'request' ;
	const RESPONSE				= 'response';
	const COOKIES				= 'cookies';
	const FILTER				= 'filter';
	const FLASH					= 'flash';
	const FLASH_SESSION 		= 'flashSession';
	const EVENTS_MANAGER 		= 'eventsManager';
	const DB					= 'db';
	const SECURITY				= 'security';
	const CRYPT					= 'crypt';
	const TAG					= 'tag';
	const ESCAPER				= 'escpaer';
	const ANNOTATIONS			= 'annotations';
	const MODELS_MANAGER		= 'modelsManager';
	const MODELS_METADATA		= 'modelsMetadata';
	const TRANSACTION_MANAGER	= 'transactionManager';
	const MODELS_CACHE			= 'modelsCache';
	const VIEWS_CACHE			= 'viewsCache';
	
	public $service ;
	
	public function __construct($serviceName){
		parent::__construct();
		if($this->isEnumValue($serviceName)){
			$this->service = $this->$serviceName = Engine::getInstance()->getService($serviceName);
		}else self::throwException($serviceName,200);
	}
	
	public static function get($serviceName){
		try{
			return Engine::getInstance()->getService($serviceName);
		}catch (\Phalcon\DI\Exception $e){
			self::throwException($serviceName,200);
		}
	}
	
	public static function throwException($message = null, $code = 0, Exception $previous = null) {
		throw new Exception($message,$code,$previous);
	}

}