<?php
/**********************************************************************************************/
/* 									[CONFIGURATION]											  */

$config = array(
	'moduleDir'			=> 'MyAwesomeModule',
	'namespace'			=> 'Vendor\App\Awesome',
	'moduleName'		=> 'awesome',
	'useVolt'			=> true,
	'permissionGroup'	=> array(
			'GROUP_BASE',
	),
	'permissions'		=> array(	
			'VOLT',
	),
);










/**********************************************************************************************/
createModuleStruct();
/**********************************************************************************************/
function createModuleStruct($n = 0){
	global $config ;
	
	$dir = $n > 0 ? $config['moduleDir'].$n : $config['moduleDir'];
	$namespace = $config['namespace'];
	$moduleName	= $n > 0 ? $config['moduleName'].$n : $config['moduleName'];
	$use = $config['useVolt'] ? 'use Thunderstruct\API\Adapters\ModuleVolt as ModuleAdapter;' : 'use Thunderstruct\API\Adapters\Module as ModuleAdapter;';
	
	if(!file_exists($dir)){
		mkdir($dir);
		mkdir($dir.'/controllers');
		mkdir($dir.'/modules');
		mkdir($dir.'/views');
		
		$module = fopen($dir.'/Module.php','w');
		fwrite($module,'<?php
namespace '.$namespace.';
				
'.$use.'

class Module extends ModuleAdapter{
}');
		
		fclose($module);
		
		foreach ($config['permissionGroup'] as $group){
			$permissionGroup = '<group>Service::'.$group.'</group>'.PHP_EOL ;
		}
		
		foreach ($config['permissions'] as $permission){
			$permissions .= '<permission>Service::'.$permission.'</permission>'.PHP_EOL ;
		}
		
		$manifest = fopen($dir.'/Manifest.xml', 'w');
		fwrite($manifest,'<?xml version="1.0" encoding="UTF-8"?>
<Module>
	<namespace>'.$namespace.'</namespace>
	<name>'.$moduleName.'</name>
	
	<routing>
		<route>'.$moduleName.'</route>
	</routing>
	
	<permissions>
		'.$permissionGroup.'
		'.$permissions.'
	</permissions>
</Module>');
		
		fclose($manifest);
		
		echo 'Module "'.$dir.'" successfully created !';
	}else{
		createModuleStruct(++$n);
	}
}