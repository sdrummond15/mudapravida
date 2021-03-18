<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_species
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Species component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_species
 * @since       1.6
 */
class SpeciesHelper
{
	public static function addSubmenu($vName)
	{
                    JHtmlSidebar::addEntry(
                    JText::_('COM_SPECIES_SUBMENU_SPECIES'),
                    'index.php?option=com_species&view=species',
                    $vName == 'species'
                );
                    JHtmlSidebar::addEntry(
                    JText::_('COM_SPECIES_SUBMENU_CATEGORIES'),
                    'index.php?option=com_categories&extension=com_species',
                    $vName == 'categories'
                );
                    
        }
        
        public static function getActions()
        {
            $user = JFactory::getUser();
            $result = new JObject;
            $assetName = 'com_species';
            
            $actions = array(
                'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.delete'
            );
            
            foreach ($actions as $action) {
                $result ->set($action, $user->authorise($action,$assetName));
            }
            return $result;
            
        }
        
}
