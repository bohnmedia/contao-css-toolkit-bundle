<?php

namespace BohnMedia\CssToolkitBundle\Library;

use BohnMedia\CssToolkitBundle\Library\SassUtil;
use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;
use Contao\File;
use Contao\FilesModel;
use Contao\LayoutModel;
use Contao\StringUtil;
use Leafo\ScssPhp\Compiler;

class Generator
{
	
	/**
	 * Construct
	 *
	 * @param array $defaults Default arrays from config.yml
	 */
	public function __construct($defaults)
	{
		$this->defaults = $defaults;
	}

	private function grid($activeRecord)
	{
		return \Contao\ThemeModel::findById($activeRecord->pid)->bs_grid_columns ?: $this->defaults['grid'];
	}
	
	private function is_active($activeRecord, $name)
	{
		foreach ($GLOBALS['TL_DCA']['tl_css_toolkit']['subpalettes'] as $subpaletteName => $subpaletteValue) {
			$subpalette = preg_split("/[\s,;]+/",$subpaletteValue);
			if (in_array($name,$subpalette)) {
				return ($activeRecord->{$subpaletteName} == "1");
			}
		}
		return true;
	}
	
	private function generate_config($activeRecord)
	{
		\Contao\Controller::loadDataContainer('tl_css_toolkit');
		$config = "";
		foreach ($GLOBALS['TL_DCA']['tl_css_toolkit']['fields'] as $name => $field) {
			if (!empty($field["eval"]["exportToSass"])) {
				if ($this->is_active($activeRecord, $name)) {
					$config .= "\$" . $name . ":" . SassUtil::encode($activeRecord->{$name}) . ";";
				} else {
					$config .= "\$" . $name . ":null;";
				}
			}
		}
		$config .= "\$grid:" . $this->grid($activeRecord) . ";";
		return $config;
	}
	

	private function generate_internal()
	{
		return "@import '" . realpath(__DIR__ . "/../Scss/csstoolkit.scss") . "';";
	}

	private function generate_external($activeRecord)
	{
		$output = "";
		
		// Get files after update
		$filesStr = CssToolkitModel::findById($activeRecord->id)->orderExt;
		$filesArr = StringUtil::deserialize($filesStr);
		$filesObj = FilesModel::findMultipleByUuids($filesArr);
		while ($filesObj && $filesObj->next()) {
			$output .= "@import '" . realpath('../' . $filesObj->path) . "';";
		}

		return $output;
	}

	private function generate_css($activeRecord)
	{
		
		// GET SCSS TEMPLATE
		$cssSource = $this->generate_config($activeRecord);
		$cssSource .= $activeRecord->custom;
		$cssSource .= $this->generate_internal();
		$cssSource .= $this->generate_external($activeRecord);
		
		// COMPILE CSS
		$ScssPhp = new Compiler();
		$ScssPhp->setFormatter('\\Leafo\\ScssPhp\\Formatter\\Crunched');
		$css = $ScssPhp->compile($cssSource);
				
		// WRITE FILE
		$objFile = new File('web/bundles/csstoolkit/css/'.$activeRecord->id.'.css');
		$objFile->write($css);
		$objFile->close();
		
	}
	
	public function generate_css_from_tl_theme($dc)
	{
		$objCssToolkits = CssToolkitModel::findByPid($dc->id);
		while($objCssToolkits && $objCssToolkits->next()){
			$this->generate_css($objCssToolkits);
		}
	}
	
	public function generate_css_from_tl_css_toolkit($dc)
	{
		$this->generate_css($dc->activeRecord);
	}
	
}