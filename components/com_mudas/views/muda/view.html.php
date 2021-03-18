<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
JPluginHelper::importPlugin('content.joomplu');

class MudasViewMuda extends JViewLegacy {

    function display($tpl = null) {
        
        $this->muda = $this->get('Muda');
        
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_mudas/css/stylemudas.css');
        $doc->addStyleSheet('components/com_mudas/css/lightbox.css');
        $doc->addScript('components/com_mudas/js/lightbox-plus-jquery.js');
        
        parent::display($tpl);
    }
}
