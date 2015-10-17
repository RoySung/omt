<?php
namespace Home\Common;
class PublicFunction {
    function ArrayUnique($array)
    {
    	$out = array();
    	foreach ($array as $key=>$value) {
    		if (!in_array($value, $out))
    		{
    			array_push($out, $value);
    		}
    	}
    	return $out;
    }
}