<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2008-2011
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
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

