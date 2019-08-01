<?php

$GLOBALS['TL_DCA']['tl_css_toolkit'] = array
(
	'config' => array
	(
		'dataContainer'	=> 'Table',
		'ptable'	=> 'tl_theme',
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
			'child_record_callback'   => array('tl_css_toolkit', 'listToolkit')
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
		'default'	=>	'{title_legend},name;{title_breakpoint},breakpoint'
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
		'breakpoint' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['breakpoint'],
			'inputType'				  => 'multiColumnWizard',
			'eval'					  =>
			[
				'tl_class'			  => 'w50',
				'dragAndDrop'		  => true,
				'columnFields'		  =>
				[
					'name'			  =>
					[
						'label'		  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['breakpoint_name'],
						'inputType'	  => 'text',
						'eval'		  =>
						[
							'style'	  => 'width:357px'
						]
					],
					'infix'			  =>
					[
						'label'		  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['breakpoint_infix'],
						'inputType'	  => 'text',
						'eval'		  =>
						[
							'style'	  => 'width:60px',
							'maxlength' => 3
						]
					],
					'value'			  =>
					[
						'label'		  => &$GLOBALS['TL_LANG']['tl_css_toolkit']['breakpoint_value'],
						'inputType'	  => 'text',
						'eval'		  =>
						[
							'style'	  => 'width:60px',
							'rgxp'	  => 'natural'
						]
					]
				]
			],
			'save_callback'			  => array(array('tl_css_toolkit','saveBreakpoint')),
			'default'				  => 'a:5:{i:0;a:3:{s:4:"name";s:11:"Extra small";s:5:"infix";s:2:"xs";s:5:"value";s:1:"0";}i:1;a:3:{s:4:"name";s:5:"Small";s:5:"infix";s:2:"sm";s:5:"value";s:3:"576";}i:2;a:3:{s:4:"name";s:6:"Medium";s:5:"infix";s:2:"md";s:5:"value";s:3:"768";}i:3;a:3:{s:4:"name";s:5:"Large";s:5:"infix";s:2:"lg";s:5:"value";s:3:"992";}i:4;a:3:{s:4:"name";s:11:"Extra large";s:5:"infix";s:2:"xl";s:5:"value";s:4:"1200";}}',
			'sql'					  => 'blob NULL'
		)
	)
);

class tl_css_toolkit extends Contao\Backend
{

	private static function sortBreakpoint($a,$b) {
		$intA = (int)$a["value"];
		$intB = (int)$b["value"];
		if ($intA === $intB) return 0;
		return ($intA < $intB) ? -1 : 1;
	}

	public function listToolkit($row)
	{
		return '<div class="tl_content_left">'. $row['name'] .'</div>';
	}

	public function saveBreakpoint($varValue, $dc)
	{
		$value = unserialize($varValue);
		usort($value, array('tl_css_toolkit','sortBreakpoint'));
		return serialize($value);
	}

}