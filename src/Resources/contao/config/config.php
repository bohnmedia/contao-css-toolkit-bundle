<?php

	$GLOBALS['TL_MODELS']['tl_css_toolkit'] = "BohnMedia\\CssToolkitBundle\\Model\\CssToolkitModel";
	
	$GLOBALS['BE_MOD']['design']['themes']['tables'][] = "tl_css_toolkit";
	
	$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('bohnmedia.css_toolkit_bundle.hooks', 'get_page_layout');

?>