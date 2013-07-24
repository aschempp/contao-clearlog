<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2009-2013
 * @author     Andreas Schempp <andreas.schempp@terminal42.ch>
 * @license    LGPL
 */


/**
 * Config
 */
$GLOBALS['TL_DCA']['tl_log']['config']['onload_callback'][] = array('tl_log_clearlog', 'addOperation');


class tl_log_clearlog extends Backend
{

	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function addOperation()
	{
		if ($this->User->hasAccess('maintenance', 'modules'))
		{
			$GLOBALS['TL_DCA']['tl_log']['list']['global_operations']['clearlog'] = array
			(
				'label'			=> &$GLOBALS['TL_LANG']['tl_log']['clearlog'],
				'href'			=> 'key=clearlog',
				'class'			=> 'clearlog',
				'attributes'	=> 'onclick="Backend.getScrollOffset();" accesskey="c"'
			);
		}
	}

	/**
	 * Truncate table tl_log
	 * @return void
	 */
	public function clearLog()
	{
		if (!$this->User->hasAccess('maintenance', 'modules'))
		{
			$this->log('Back end module "maintenance" was not allowed for user "' . $this->User->username . '"', 'tl_log_clearlog clearLog()', TL_ERROR);
			$this->redirect($this->Environment->script . '?act=error');
		}

		$this->Database->query('TRUNCATE tl_log');
		$this->redirect($this->Environment->script . '?do=log');
	}
}

