<?php

$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = preg_replace(
	'/([;,]external)([;,])/',
	'$1,cssToolkit$2',
	$GLOBALS['TL_DCA']['tl_layout']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['cssToolkit'] = Array(
	'label'					  => &$GLOBALS['TL_LANG']['tl_layout']['cssToolkit'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('bohnmedia.css_toolkit_bundle.css_toolkit_class','options_callback'),
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default 0"
);