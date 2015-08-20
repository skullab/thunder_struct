<?php
namespace Thunderstruct\API\Assets;

class Manager extends \Phalcon\Assets\Manager{
	
	private $baseUri = '' ;
	
	public function __construct($options = null){
		parent::__construct($options);
		if(array_key_exists('baseUri', $this->getOptions())){
			$this->baseUri = $this->getOptions()['baseUri'];
		}	
	}
	
	public function addCss ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		parent::addCss($path,$local,$filter,$attributes);
	}
	
	public function addJs ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		parent::addJs($path,$local,$filter,$attributes);
	}
	
}