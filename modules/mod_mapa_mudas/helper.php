<?php
/**
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Site
 * @subpackage	mod_qualification
 * @since		1.5
 */
class modMapa_MudasHelper
{
    public static function getMapa_Mudas(){
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__muda As i');
        $query->where('i.tipo = 0 AND i.destaque = 1');
        
        $db->setQuery($query);
	$rows = (array) $db->loadObjectList();
        
        return $rows;
    }
    
}