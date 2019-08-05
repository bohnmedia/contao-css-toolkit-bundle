<?php

	// NEW OPERATION
	$operations = array(
		'cssToolkit' => array(
			'href' => 'table=tl_css_toolkit',
			'icon' => 'bundles/csstoolkit/css.svg'
		)
	);
	
	// FIND INDEX OF CSS
	$cssIndex = array_search("css",array_keys($GLOBALS['TL_DCA']['tl_theme']['list']['operations'])) + 1;
	
	// INSERT AFTER CSS
	$GLOBALS['TL_DCA']['tl_theme']['list']['operations'] = array_merge(
		array_slice($GLOBALS['TL_DCA']['tl_theme']['list']['operations'], 0, $cssIndex),
		$operations,
		array_slice($GLOBALS['TL_DCA']['tl_theme']['list']['operations'], $cssIndex)
	);