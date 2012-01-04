<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @copyright  Andreas Schempp 2011
 * @author     Leo Unglaub <leo@leo-unglaub.net>
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id: tl_module.php 324 2011-07-26 16:07:53Z aschempp $
 */


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['mail_template'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['mail_template'],
	'inputType'			=> 'select',
	'options_callback'	=> array('tl_module_mail_templates', 'getMailTemplates'),
	'eval'				=> array('mandatory'=>true, 'includeBlankOption'=>true),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['admin_mail_template'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_module']['admin_mail_template'],
	'inputType'			=> 'select',
	'options_callback'	=> array('tl_module_mail_templates', 'getMailTemplates'),
	'eval'				=> array('mandatory'=>true, 'includeBlankOption'=>true),
);


class tl_module_mail_templates extends Backend
{

	/**
	 * Get array of available mail templates
	 *
	 * @return array
	 */
	public function getMailTemplates()
	{
		$arrTemplates = array();
		$objTemplates = $this->Database->execute("SELECT id,name,category FROM tl_mail_templates ORDER BY category, name");
		
		while( $objTemplates->next() )
		{
			if ($objTemplates->category == '')
			{
				$arrTemplates[$objTemplates->id] = $objTemplates->name;
			}
			else
			{
				$arrTemplates[$objTemplates->category][$objTemplates->id] = $objTemplates->name;
			}
		}
		
		return $arrTemplates;
	}
}

