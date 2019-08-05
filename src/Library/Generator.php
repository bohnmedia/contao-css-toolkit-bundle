<?php

namespace BohnMedia\CssToolkitBundle\Library;

use BohnMedia\CssToolkitBundle\Library\SassUtil;
use Contao\File;
use Leafo\ScssPhp\Compiler;

class Generator
{

	private $activeRecord;
	
	private function generate_config()
	{
		$config = "";
		foreach ($GLOBALS['TL_DCA']['tl_css_toolkit']['fields'] as $name => $field) {
			if (!empty($field["eval"]["exportToSass"])) {
				$config .= "\$" . $name . ":" . SassUtil::encode($this->activeRecord->{$name}) . ";";
			}
		}
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