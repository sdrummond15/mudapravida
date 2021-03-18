<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
JPluginHelper::importPlugin('content.joomplu');

class MudasViewMudas_Separate extends JViewLegacy {

    function display($tpl = null) {
        
        $this->mudas_separate = $this->get('Mudas_Separate');
        
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_mudas/css/stylemudas.css');
        parent::display($tpl);
    }
}
