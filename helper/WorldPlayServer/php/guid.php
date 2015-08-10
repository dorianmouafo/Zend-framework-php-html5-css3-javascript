<?php


/**
 * 
 */
class Guid {
	
	function __construct($argument) {
		
	}
	
	static public function uuid($value='')
	{
		mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = $value// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        return $uuid;
	}
}
// Echo uuid
// print Guid::uuid();
?>