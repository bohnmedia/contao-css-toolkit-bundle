<?php

$GLOBALS['TL_DCA']['tl_css_toolkit'] = array
(
	'config' => array
	(
		'dataContainer'		=> 'Table',
		'ptable'			=> 'tl_theme',
		'oncreate_callback'	=> array(array('bohnmedia.css_toolkit_bundle.table','csstoolkit_oncreate_callback')),
		'ondelete_callback'	=> array(array('bohnmedia.css_toolkit_bundle.table','csstoolkit_ondelete_callback')),
		'onsubmit_callback'	=> array(array('bohnmedia.css_toolkit_bundle.generator','generate_css_from_tl_css_toolkit')),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),
	'list' => array
	(
		'sorting' => array
		(
			'mode'		=> 4,
			'fields'	=> array('name'),
			'panelLayout'	=> 'filter;sort,search,limit',
			'headerFields'	=> array('name', 'author', 'tstamp'),
			'child_record_callback'   => array('bohnmedia.css_toolkit_bundle.table','list_toolkit')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'				  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'		=> &$GLOBALS['TL_LANG']['tl_css_toolkit']['edit'],
				'href'		=> 'act=edit',
				'icon'		=> 'edit.svg'
			),
			'copy' => array
			(
				'label'		=> &$GLOBALS['TL_LANG']['tl_css_toolkit']['copy'],
				'href'		=> 'act=paste&amp;mode=copy',
				'icon'		=> 'copy.svg',
				'attributes'	=> 'onclick="Backend.getScrollOffset()"'
			),
			'cut' => array
			(
				'label'		=> &$GLOBALS['TL_LANG']['tl_css_toolkit']['cut'],
				'href'		=> 'act=paste&amp;mode=cut',
				'icon'		=> 'cut.svg',
				'attributes'	=> 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'		=> &$GLOBALS['TL_LANG']['tl_css_toolkit']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.svg',
				'attributes'	=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'		=> &$GLOBALS['TL_LANG']['tl_css_toolkit']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.svg'
			)
		)
	),
	'palettes' => array
	(
		'__selector__'	=>	array('addWidths','addHeights'),
		'default'		=>	'{title_legend},name;{base_legend},baseSize,fontFamily,fontSize,fontWeight,fontColor;{breakpoints_legend},breakpoints,containerMaxWidths,headerHeights;{grids_legend},gridPadding;{colors_legend},colors;{fonts_legend},fonts,fontSizes;{spacings_legend},spacings;{heights_widths_legend},addHeights,addWidths;{expert_legend:hide},custom,external;'
	),
	'subpalettes'		=> array
	(
		'addWidths'		=> 'widths',
		'addHeights'	=>	'heights'
	),
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_theme.name',
			'sql'                     => "int(10) unsigned NOT NULL default 0",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'name' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['name'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'baseSize' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['baseSize'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'w50','exportToSass'=>true),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'fontFamily' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fontFamily'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50','exportToSass'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fontSize' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fontSize'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>4, 'tl_class'=>'w50','exportToSass'=>true),
			'sql'                     => "varchar(4) NOT NULL default ''"
		),
		'fontWeight' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fontWeight'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>10, 'tl_class'=>'w50','exportToSass'=>true),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'fontColor' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fontColor'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>32, 'tl_class'=>'w50','exportToSass'=>true),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'breakpoints' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['breakpoints'],
			'inputType'				  => 'keyValueWizard',
			'eval'					  => array(
				'exportToSass'		  => true
			),
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','save_keyValueWizard_sorted')
			),
			'sql'					  => 'blob NULL'
		),
		'containerMaxWidths' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['containerMaxWidths'],
			'inputType'				  => 'keyValueWizard',
			'eval'					  => array(
				'exportToSass'		  => true
			),
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','save_keyValueWizard_sorted')
			),
			'sql'					  => 'blob NULL'
		),
		'headerHeights' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['headerHeights'],
			'inputType'				  => 'keyValueWizard',
			'eval'					  => array(
				'exportToSass'		  => true
			),
			'sql'					  => 'blob NULL'
		),
		'gridPadding' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['gridPadding'],
			'inputType'				  => 'keyValueWizard',
			'eval'					  => array(
				'exportToSass'		  => true
			),
			'sql'					  => 'blob NULL'
		),
		'fonts' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fonts'],
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'inputType'				  => 'keyValueWizard',
			'eval'                    => array('mandatory'=>true, 'exportToSass'=>true),
			'sql'					  => 'blob NULL'
		),
		'fontSizes' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['fontSizes'],
			'inputType'				  => 'listWizard',
			'eval'					  => [
				'exportToSass'		  => true,
				'tl_class'			  => 'w50',
				'rgxp'				  => 'digit',
				'style'	    		  => 'width:50px'
			],
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','order_listWizard')
			),
			'sql'					  => 'blob NULL'
		),
		'colors' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['colors'],
			'inputType'				  => 'keyValueWizard',
			'eval'					  => array(
				'exportToSass'		  => true
			),
			'sql'					  => 'blob NULL'
		),
		'spacings' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['spacings'],
			'inputType'				  => 'listWizard',
			'eval'					  => [
				'exportToSass'		  => true,
				'tl_class'			  => 'w50',
				'rgxp'				  => 'digit',
				'style'	    		  => 'width:50px'
			],
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','add_zero_listWizard'),
				array('bohnmedia.css_toolkit_bundle.table','order_listWizard')
			),
			'sql'					  => 'blob NULL'
		),
		'addHeights' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['addHeights'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'heights' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['heights'],
			'inputType'				  => 'listWizard',
			'eval'					  => [
				'exportToSass'		  => true,
				'tl_class'			  => 'w50',
				'rgxp'				  => 'digit',
				'style'	    		  => 'width:50px'
			],
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','order_listWizard')
			),
			'sql'					  => 'blob NULL'
		),
		'addWidths' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['addWidths'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'widths' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['widths'],
			'inputType'				  => 'listWizard',
			'eval'					  => [
				'exportToSass'		  => true,
				'tl_class'			  => 'w50',
				'rgxp'				  => 'digit',
				'style'	    		  => 'width:50px'
			],
			'save_callback'			  => array(
				array('bohnmedia.css_toolkit_bundle.table','order_listWizard')
			),
			'sql'					  => 'blob NULL'
		),
		'external' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['external'],
			'inputType'               => 'fileTree',
			'eval'                    => array('multiple'=>true, 'fieldType'=>'checkbox', 'filesOnly'=>true, 'extensions'=>'css,scss,less', 'orderField'=>'orderExt'),
			'sql'                     => "blob NULL"
		),
		'orderExt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['sortOrder'],
			'sql'                     => "blob NULL"
		),
		'custom' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['custom'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:120px', 'preserveTags'=>true, 'class'=>'monospace', 'rte'=>'ace', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
	)
);