<?php
	
	// NEW OPERATION
	$operations = array(
		'cssUtils' => array(
			'href' => 'table=tl_cssutils',
			'icon' => 'bundles/cssutils/css.svg'
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
