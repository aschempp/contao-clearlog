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
 * TL_CACHE
 */
$GLOBALS['TL_CACHE'][] = 'tl_log';


/**
 * Backend Modules
 */
$GLOBALS['BE_MOD']['system']['log']['clearlog'] = array('tl_log_clearlog', 'clearLog');
$GLOBALS['BE_MOD']['system']['log']['stylesheet'] = 'system/modules/clearlog/assets/clearlog.css';

