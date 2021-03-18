<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class SpeciesModelSpecies extends JModelLegacy
{
    
    
    public function getSpecies()
    {
        
        $jinput = JFactory::getApplication()->input;
        
        $categoria = $jinput->get('catid');
              
        $db = JFactory::getDBO();
        
        if(!empty($categoria)){
            $where = 'WHERE (c.id = '. $categoria .') ';
        }
        
        if(empty($where)){
            $where = 'WHERE p.published = 1';
        }else{
	    $where .= 'AND p.published = 1';
	}
        
        $query = "SELECT p.id AS id, 
                         p.name AS name,
                         p.catid AS catid,
                         p.description AS description,
                         p.image1 AS image1, 
                         c.title AS categoria
                         FROM #__species AS p JOIN #__categories AS c ON p.catid = c.id 
           " . $where ." ORDER BY p.created DESC " ;

        $db->setQuery($query);
        
        $item = $db->loadObjectList();
        //echo $query;
        return $item;
    }
    
    
    public function getProdutosItem()
    {
        
        $id = JRequest::getVar("id");
       
        if(!empty($id)){
            $db = JFactory::getDBO();
            $query = 'SELECT '
                .'p.id AS id, '
                .'p.name AS name, '
                .'p.alias AS alias, '
                .'p.catid AS catid, '
                .'p.description AS description, '
                .'p.image1 AS image1, '
                .'c.title AS categoria '
                .'FROM #__species AS p '
                .'JOIN #__categories AS c '
                .'ON p.catid = c.id '
                .'WHERE p.id = '.$id;

        $db->setQuery($query);
        
        $item = $db->loadObjectList();
        
        return $item;
        
        }
        
        return 0;
        
    }
    
}