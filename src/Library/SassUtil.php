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
		$value = $val;
		
		// Is string escaped
		$escaped = preg_match('/^"((?!(?<!\\\\)").)*"$|^\'((?!(?<!\\\\)\').)*\'$/s',$value);
		
		// Does string needs to be escaped?
		if (strpos($value, ',') !== false && !$escaped) {
			$value = "'" . str_replace("'", "\\'", $value) . "'";
		}
		
		// Decode characters
		$value = str_replace("&#35;","#",$value);
		
		return $value;
	}
	
	/**
	 * Generate sass variable from keyvalue wizard
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
	 * Generate sass variable from list wizard
	 *
	 * @param Array $arr
	 */
	private function encode_array($arr)
	{
		$output = array();
		foreach($arr as $value) {
			$output[] = self::encode_string($value);
		}
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