<?php

namespace BohnMedia\CssToolkitBundle\Classes;

use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;
use Contao\File;
use Contao\StringUtil;
use Leafo\ScssPhp\Compiler;

class Generator
{

	private $activeRecord;
	private $maps = Array("breakpoints","colors");
	
	private function generate_map($name,$suffix="")
	{
		$map = array();
		$values = StringUtil::deserialize($this->activeRecord->{$name});
				
		if ($values)
		{
			foreach ($values as $value)
			{
				if ($value["name"] !== "")
				{
					$map[] = $value["name"] . ":" . str_replace("&#35;","#",$value["value"]);
				}
			}
		}
		
		return "\$" . $name . ":(".implode(",",$map).");";
	}

	private function generate_config()
	{
		$config = implode(
			"\r\n",
			array_map(
				array("\\BohnMedia\\CssToolkitBundle\\Classes\\Generator","generate_map"),
				$this->maps
			)
		);
		return $config;
	}

	public function csstoolkit_onsubmit_callback($dc)
	{
		$this->activeRecord = $dc->activeRecord;
		
		// GET SCSS TEMPLATE
		$cssSource = $this->generate_config();
		$cssSource .= "@import '" . realpath(__DIR__."/../Scss/csstoolkit.scss") . "';";
		
		// COMPILE CSS
		$ScssPhp = new Compiler();
		$ScssPhp->setFormatter('\\Leafo\\ScssPhp\\Formatter\\Crunched');
		$css = $ScssPhp->compile($cssSource);
		
		// WRITE FILE
		$objFile = new File('web/bundles/csstoolkit/css/'.$dc->id.'.css');
		$objFile->write($css);
		$objFile->close();
		
	}
	
}