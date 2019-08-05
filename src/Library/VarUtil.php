<?php

namespace BohnMedia\CssToolkitBundle\Library;

class VarUtil {
	
	/**
	 * Direct check for type
	 * for example: is_string
	 *
	 * @param Mixed $var
	 */
	public static function __call($name, $arguments)
	{
		if (substr($name,0,3) === "is_") {
			return (substr($name,3) === self::get_type($arguments[0]));
		}
	}
	 
	/**
	 * Get type of variable
	 *
	 * @param Mixed $var
	 */
	public static function get_type($var)
	{
		$type = gettype($var);
		if ($type !== "array") {
			return $type;
		} else if(isset($var[0]["key"]) && isset($var[0]["value"])) {
			return "keyvalue";
		} else {
			return "array";
		}
	}
	
}