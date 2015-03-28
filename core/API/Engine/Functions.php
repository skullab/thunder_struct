<?php

if(!function_exists('boolval')) {
    function boolval($BOOL, $STRICT=false) {

        if(is_string($BOOL)) {
            $BOOL = strtoupper($BOOL);
        }

        // no strict test, check only against false bool
        if( !$STRICT && in_array($BOOL, array(false, 0, NULL, 'FALSE', 'NO', 'N', 'OFF', '0'), true) ) {

            return false;

        // strict, check against true bool
        } elseif($STRICT && in_array($BOOL, array(true, 1, 'TRUE', 'YES', 'Y', 'ON', '1'), true) ) {

            return true;

        }

        // let PHP decide
        return $BOOL ? true : false;
    }
}

$dump = true ;
function enableDump($value){
	global $dump ;
	$dump = boolval($value);
}
function dump($expression){
	global $dump ;
	if($dump)var_dump($expression);
}