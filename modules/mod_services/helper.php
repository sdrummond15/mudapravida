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
class modServicesHelper
{
    public static function getServices($category = null)
    {
        if (!empty($category)) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__categories');
            $query->where('id in (' . $category . ')');
            $query->order('field(id, ' . $category . ')');
            $query->setLimit(3);

            $db->setQuery($query);
            $rows = (array) $db->loadObjectList();

            return $rows;
        }
        return $category;
    }
}
