<?php

$GLOBALS['TL_DCA']['tl_css_toolkit'] = array
(
	'config' => array
	(
		'dataContainer'		=> 'Table',
		'ptable'			=> 'tl_theme',
		'oncreate_callback'	=> array(array('bohnmedia.css_toolkit_bundle.table','csstoolkit_oncreate_callback')),
		'ondelete_callback'	=> array(array('bohnmedia.css_toolkit_bundle.table','csstoolkit_ondelete_callback')),
		'onsubmit_callback'	=> array(array('bohnmedia.css_toolkit_bundle.generator','csstoolkit_onsubmit_callback')),
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
	'palettes' => array(
		'default'	=>	'{title_legend},name;{title_base},baseSize,fontSize;{title_breakpoints},breakpoints;{title_colors},colors;{title_spacings},spacings'
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
		)
	)
);