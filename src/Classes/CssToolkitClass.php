<?php

namespace BohnMedia\CssToolkitBundle\Classes;

use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;

class CssToolkitClass
{

	public function options_callback($dc) {
		
		$output = Array("0" => "-");
		$objCssToolkits = CssToolkitModel::findByPid($dc->id);
		while($objCssToolkits && $objCssToolkits->next()){
			$output[$objCssToolkits->id] = $objCssToolkits->name;
		}
		return $output;
		
	}
	
}