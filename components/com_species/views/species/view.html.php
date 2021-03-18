<?php

 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
 
class SpeciesViewSpecies extends JViewLegacy
{
   
    protected $species;
    protected $produtositem;
    
            function display($tpl = null)
    {
            
           $this->species          = $this->get('Species');
           $this->produtositem      = $this->get('ProdutosItem');
           
           
       $doc = JFactory::getDocument();
       $doc->addStyleSheet('components/com_species/css/stylespecie.css');
       parent::display($tpl);
    }
    
}