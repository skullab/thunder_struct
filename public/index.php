<?php
require '../core/API/Engine.php';
use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Tokenizer;
use Thunderstruct\API\Engine\Constants;
use Thunderstruct\API\Permission;
use Thunderstruct\API\Thunderstruct\API;



//class_alias('Thunderstruct\API\Engine\Engine', 'Thunderstruct');

$e = new Engine();
//var_dump($e->getModuleDefinition('defaultModule'));
echo $e->handle()->getContent();





