<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_species
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class SpeciesController extends JControllerLegacy
{
    protected $default_view = 'species';
    
    public function display($cachable = false, $urlparams = false)
    {
    
        require_once JPATH_COMPONENT.'/helpers/species.php';
        
        SpeciesHelper::addSubmenu(JRequest::getCmd('view','species'));
        
        $view = JRequest::getCmd('view', 'species');
        $layout = JRequest::getCmd('layout', 'default');
        $view = JRequest::getCmd('id');
        
        parent::display();
        
        return $this;

    }
}
