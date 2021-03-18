<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_species
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('behavior.tabstate');

if (!JFactory::getUser()->authorise('core.manage', 'com_species'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

jimport('joomla.application.component.controller');

// Execute the task.
$controller = JControllerLegacy::getInstance('Species');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
