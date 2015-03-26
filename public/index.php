<?php
require '../core/API/Engine.php';
require '../core/API/Debug/Log.php';

use Thunderstruct\API\Engine;
use Thunderstruct\API\Service;
use Thunderstruct\API\Tokenizer;
use Thunderstruct\API\Engine\Constants;
use Thunderstruct\API\Permission;
use Thunderstruct\API\Debug\Log;
use Thunderstruct\API\Thunderstruct\API;

//class_alias('Thunderstruct\API\Engine\Engine', 'Thunderstruct');
Log::active(true);
Log::enableBacktrace(true);
Log::sessionStart();

$e = new Engine();
try{
echo $e->handle()->getContent();
}catch(Exception $e){}

Log::sessionEnd();



