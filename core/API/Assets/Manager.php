<?php
namespace Thunderstruct\API\Assets;

use Thunderstruct\API\Autoloader;
use Thunderstruct\API\Engine;
class Manager extends \Phalcon\Assets\Manager{
	
	private $baseUri = '' ;
	private $standardUri = '' ;
	private $libUri	= '';
	private $jqueryUri = '' ;
	private $stackCss = array();
	private $stackJs = array();
	private $stackStandardCss = array();
 	private $stackStandardJs = array();
 	private $stackJQuery = array();
 	
	public function __construct($options = null){
		parent::__construct($options);
		if(array_key_exists('baseUri', $this->getOptions())){
			$this->baseUri = $this->getOptions()['baseUri'];
		}
		$dirs = Engine::getInstance()->getConfigDirs();
		$this->standardUri = $dirs['assets']->standard ;
		$this->libUri = $dirs['assets']->lib ;
		$this->jqueryUri = $dirs['lib']->jquery ;
	}
	
	public function addCss ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		$this->stackCss[$path] = array(
				'local'			=> $local,
				'filter'		=> $filter,
				'attributes'	=>$attributes
		);
		parent::addCss($path,$local,$filter,$attributes);
	}
	
	public function addJs ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		$this->stackJs[$path] = array(
				'local'			=> $local,
				'filter'		=> $filter,
				'attributes'	=>$attributes
		);
		parent::addJs($path,$local,$filter,$attributes);
	}
	
	public function addStandardCss ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->standardUri . $path ;
		$this->stackStandardCss[$path] = array(
				'local'			=> $local,
				'filter'		=> $filter,
				'attributes'	=>$attributes
		);
		parent::addCss($path,$local,$filter,$attributes);
	}
	
	public function addStandardJs ($path, $local = true, $filter = true, $attributes = null){
		$path = $this->standardUri . $path ;
		$this->stackStandardJs[$path] = array(
				'local'			=> $local,
				'filter'		=> $filter,
				'attributes'	=>$attributes
		);
		parent::addJs($path,$local,$filter,$attributes);
	}
	
	public function requireCss($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		if(!array_key_exists($path, $this->stackCss)){
			$this->stackCss[$path] = array(
					'local'			=> $local,
					'filter'		=> $filter,
					'attributes'	=>$attributes
			);
			parent::addCss($path,$local,$filter,$attributes);
		}
	}
	
	public function requireJs($path, $local = true, $filter = true, $attributes = null){
		$path = $this->baseUri . $path ;
		if(!array_key_exists($path, $this->stackJs)){
			$this->stackJs[$path] = array(
					'local'			=> $local,
					'filter'		=> $filter,
					'attributes'	=>$attributes
			);
			parent::addJs($path,$local,$filter,$attributes);
		}
	}
	
	public function requireStandardCss($path, $local = true, $filter = true, $attributes = null){
		$path = $this->standardUri . $path ;
		if(!array_key_exists($path, $this->stackStandardCss)){
			$this->stackStandardCss[$path] = array(
					'local'			=> $local,
					'filter'		=> $filter,
					'attributes'	=>$attributes
			);
			parent::addCss($path,$local,$filter,$attributes);
		}
	}
	
	public function requireStandardJs($path, $local = true, $filter = true, $attributes = null){
		$path = $this->standardUri . $path ;
		if(!array_key_exists($path, $this->stackStandardJs)){
			$this->stackStandardJs[$path] = array(
					'local'			=> $local,
					'filter'		=> $filter,
					'attributes'	=>$attributes
			);
			parent::addJs($path,$local,$filter,$attributes);
		}
	}
	
	/*************************************************************************/
	
	
	public function requireJQuery($version = null,$cdn = false){
		
		$path =  $this->jqueryUri ;
		if($cdn){
			$path = $version == null ? '//code.jquery.com/jquery.js' : '//code.jquery.com/jquery-' . $version . '.js' ;
		}else{
			$path .= $version == null ? 'jquery.js' : 'jquery-' . $version . '.js' ;
		}
		if(!array_key_exists($path, $this->stackJQuery)){
			$min = strpos($version, 'min');
			$filter = $min === false ? true : false ;
			$this->stackJQuery[$path] = array(
					'version'	=> $version,
					'min'		=> !$filter,
					'cdn'		=> $cdn
			);
			parent::addJs($path,!$cdn,$filter,null);
		}
	}
	
	public function requireJQueryCDN($version = null){
		$this->requireJQuery($version,true);
	}
}