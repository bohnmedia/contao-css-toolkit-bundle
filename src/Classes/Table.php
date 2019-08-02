<?php

namespace BohnMedia\CssToolkitBundle\Classes;

use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;
use Contao\System;
use Contao\File;

class Table extends System
{

	private $defaults;

	/**
	 * Construct
	 *
	 * @param array $defaults Default arrays from config.yml
	 */
	public function __construct($defaults)
	{
		$this->defaults = $defaults;
		$this->import('Database');
	}
	
	/**
	 * Sort twodimensional array by its value
	 *
	 * @param array $a First array
	 * @param array $b Second array
	 */
	private static function sort_by_value($a,$b) {
		$intA = (int)$a["value"];
		$intB = (int)$b["value"];
		if ($intA === $intB) return 0;
		return ($intA < $intB) ? -1 : 1;
	}

	/**
	 * Display line in overview
	 *
	 * @param array $row Row from table
	 */
	public function list_toolkit($row)
	{
		return '<div class="tl_content_left">'. $row['name'] .'</div>';
	}

	/**
	 * Display line in overview
	 *
	 * @param string $varValue Value from multi column widget
	 * @param Contao\DataContainer $dc
	 */
	public function save_breakpoints($varValue, $dc)
	{
		$value = unserialize($varValue);
		usort($value, array("\\BohnMedia\\CssToolkitBundle\\Classes\\Table","sort_by_value"));
		return serialize($value);
	}
	
	/**
	 * Generate array for multi column widget default
	 *
	 * @param array $defaultArr
	 */
	private function generate_default_value($defaultArr)
	{
		$output = Array();
		foreach($defaultArr as $key => $value)
		{
			$output[] = Array(
				"name" => $key,
				"value" => $value
			);
		}
		return $output;
	}
	
	/**
	 * Set defaults when creating a new record
	 *
	 * @param string $strTable
	 * @param string $insertID
	 * @param array  $set
	 * @param object $obj
	 */
	public function csstoolkit_oncreate_callback($strTable, $insertID, $set, $dc)
	{
		$query = Array();
		$values = Array();
		foreach(array_keys($GLOBALS['TL_DCA'][$strTable]['fields']) as $name) {
			if (isset($this->defaults[$name])) {
				$query[] = $name . "=?";
				$values[] = $this->generate_default_value($this->defaults[$name]);
			}
		}
		$values[] = $insertID;
		$this->Database->prepare("UPDATE " . $strTable . " SET " . implode(",",$query) . " WHERE id=?")->execute($values);
	}
	
	/**
	 * Delete css file on delete
	 *
	 * @param Contao\DataContainer $dc
	 */
	public function csstoolkit_ondelete_callback($dc)
	{
		$objFile = new File('web/bundles/csstoolkit/css/'.$dc->id.'.css');
		if ($objFile->exists()) {
			$objFile->delete();
		}
	}
	
	/**
	 * Options for dropdown in layout
	 *
	 * @param Contao\DataContainer $dc
	 */
	public function csstoolkit_options_callback($dc)
	{
		$output = Array("0" => "-");
		$objCssToolkits = CssToolkitModel::findByPid($dc->id);
		while($objCssToolkits && $objCssToolkits->next()){
			$output[$objCssToolkits->id] = $objCssToolkits->name;
		}
		return $output;
	}

}