<?php

use BohnMedia\CssToolkitBundle\Model\CssToolkitModel;

$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = preg_replace(
	'/([;,]external)([;,])/',
	'$1,cssToolkit$2',
	$GLOBALS['TL_DCA']['tl_layout']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['cssToolkit'] = Array(
	'label'					  => &$GLOBALS['TL_LANG']['tl_layout']['cssToolkit'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_layout_cssToolkit', 'layoutOptions'),
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default 0"
);

class tl_layout_cssToolkit
{
	
	public function layoutOptions($dc) {
		
		$output = Array("0" => "-");
		$objCssToolkits = \BohnMedia\CssToolkitBundle\Model\CssToolkitModel::findByPid($dc->id);
		while($objCssToolkits->next()){
			$output[$objCssToolkits->name] = $objCssToolkits->id;
		}
		return $output;
		
	}
	
}