<?php

namespace BohnMedia\CssToolkitBundle\Library;

use Contao\StringUtil;
use BohnMedia\CssToolkitBundle\Library\VarUtil;

class SassUtil {
	
	/**
	 * Generate sass variable from string
	 *
	 * @param String $value
	 */
	private function encode_string($val)
	{
		return str_replace("&#35;","#",$val);
	}
	
	/**
	 * Generate sass variable from multicolumn array
	 *
	 * @param Array $arr
	 */
	private function encode_keyvalue($arr)
	{
		$output = array();
		foreach ($arr as $value) {
			if ($value["key"] !== "") {
				$output[] = $value["key"] . ":" . self::encode_string($value["value"]);
			}
		}
		return "(".implode(",",$output).")";
	}
	
	/**
	 * Generate sass variable from sequential array
	 *
	 * @param Array $arr
	 */
	private function encode_array($arr)
	{
		$output = array_map("self::encode_string", $arr);
		return "(".implode(",",$output).")";
	}
	
	/**
	 * Generate sass variable
	 *
	 * @param Mixed $value
	 */
	public static function encode($value)
	{
		$val = StringUtil::deserialize($value);
		$type = VarUtil::get_type($val);
		return self::{'encode_' . $type}($val);
	}
	
}