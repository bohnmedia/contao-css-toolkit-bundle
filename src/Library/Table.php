<?php

namespace BohnMedia\CssToolkitBundle\Library;

use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;
use Contao\Backend;
use Contao\File;

class Table extends Backend
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
		$this->import("Database");
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
	 * Save breakpoints
	 *
	 * @param string $varValue Value from multi column widget
	 * @param Contao\DataContainer $dc
	 */
	public function save_breakpoints($varValue, $dc)
	{
		$value = unserialize($varValue);
		usort($value, array("\\BohnMedia\\CssToolkitBundle\\Library\\Table","sort_by_value"));
		return serialize($value);
	}
	
	/**
	 * Save ordered and unique
	 *
	 * @param string $varValue Value from list widget
	 * @param Contao\DataContainer $dc
	 */
	public function save_list($varValue, $dc)
	{
		$value = unserialize($varValue);
		array_unshift($value,"0");
		sort($value);
		return serialize(array_values(array_unique($value)));
	}
	
	/**
	 * Generate array for multi column widget default
	 *
	 * @param array $defaultArr
	 */
	private function generate_default_value_multiColumnWizard($defaultArr)
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
	 * Generate array for list widget default
	 *
	 * @param array $defaultArr
	 */
	private function generate_default_value_listWizard($defaultArr)
	{
		return $defaultArr;
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
				$type = $GLOBALS['TL_DCA'][$strTable]['fields'][$name]['inputType'];
				$query[] = $name . "=?";
				$values[] = $this->{"generate_default_value_" . $type}($this->defaults[$name]);
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
		$objCssToolkits = CssToolkitModel::findByPid($dc->id);
		while($objCssToolkits && $objCssToolkits->next()){
			$output[$objCssToolkits->id] = $objCssToolkits->name;
		}
		return $output;
	}

}