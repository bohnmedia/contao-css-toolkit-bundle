<?php

namespace BohnMedia\CssToolkitBundle\Library;

class Hooks {
	
	public function get_page_layout($objPage, $objLayout, $objPty)
	{
		if ($objLayout->cssToolkit !== "0") {
			$GLOBALS['TL_USER_CSS'][] = "bundles/csstoolkit/css/" . $objLayout->cssToolkit . ".css";
		}
	}
	
}