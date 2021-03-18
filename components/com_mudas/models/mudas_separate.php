<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class MudasModelMudas_Separate extends JModelLegacy
{
    public static function getMudas_Separate()
    {
        $db = &JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('i.id AS imovel,
                        i.name AS titulo,
                        i.descricao AS descricao,
                        i.fase AS fase,
                        i.idalbum AS album,
                        c.name AS cidade,
                        b.name AS bairro,
                        i.tipo AS tipo');
        $query->from('#__imovel As i');
        $query->join('LEFT','#__cidades AS c ON c.id = i.idcidade');
        $query->join('LEFT','#__bairros AS b ON b.id = i.idbairro');
        $query->where('i.tipo = 1');
        
        $query->where('i.published = 1');
        //echo $query;
        $db->setQuery($query);
        
        $item = $db->loadObjectList();
        //print_r($item);
        return $item;
    }
    
}