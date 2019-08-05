<?php

namespace BohnMedia\CssToolkitBundle\Library;

use Contao\StringUtil;

class Sassvariable {
	
	/**
	 * Generate sass variable from list wizard
	 *
	 * @param String $value
	 */
	private function generate_listwizard($values)
	{
		$output = $values ? StringUtil::deserialize($values) : array();
		array_unshift($output,"0");
		return "(".implode(",",array_unique($output)).")";
	}

	/**
	 * Generate sass variable from multicolumn wizard
	 *
	 * @param String $values
	 */
	private function generate_multicolumnwizard($values)
	{
		$output = array();
		if ($values) {
			foreach (StringUtil::deserialize($values) as $value) {
				if ($value["name"] !== "") {
					$output[] = $value["name"] . ":" . str_replace("&#35;","#",$value["value"]);
				}
			}
		}
		return "(".implode(",",$output).")";
	}
	
	/**
	 * Generate sass variable
	 *
	 * @param String $name
	 * @param String $dc
	 */
	public static function generate($name,$dc)
	{
		$type = $GLOBALS['TL_DCA']['tl_css_toolkit']['fields'][$name]['inputType'];
		return "\$" . $name . ":" . self::{"generate_" . strtolower($type)}($dc->{$name}) . ";";
	}
	
}