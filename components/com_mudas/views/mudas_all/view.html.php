<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
JPluginHelper::importPlugin('content.joomplu');

class MudasViewMudas_All extends JViewLegacy {

    function display($tpl = null) {
        
        $this->mudas_all = $this->get('Mudas_All');
        
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_mudas/css/stylemudas.css');
        parent::display($tpl);
    }
}
