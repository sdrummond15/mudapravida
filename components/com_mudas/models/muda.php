<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');


class MudasModelMuda extends JModelLegacy
{
    public static function getMuda()
    {
        
        $idimovel = JRequest::getInt('id');
        if(!empty($idimovel)){
            $condicao = 'i.id = '. $idimovel;
        }else{
            $id = JRequest::getInt('id');
            $condicao = 'i.id = '. $id;
        }
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('i.id AS idmuda,
                        i.idbairro AS idbairro,
                        b.name AS bairro, 
                        c.name AS cidade,
                        c.estado AS estado, 
                        i.cep AS cep, 
                        i.name AS name,
                        i.valor AS valor,
                        i.descricao AS descricao,
                        i.latitude AS latitude,
                        i.longitude AS longitude,
                        i.idalbum AS album,
                        i.fase AS fase,
                        i.instalacoes AS instalacoes,
                        i.documentacao AS documentacao,
                        i.tipo AS tipo');
        $query->from('#__muda As i');
        $query->join('LEFT','#__cidades AS c ON c.id = i.idcidade');
        $query->join('LEFT','#__bairros AS b ON b.id = i.idbairro');
        $query->where($condicao);
        $db->setQuery($query);
        $item = $db->loadObjectList();
        return $item;
    }
    public static function FotosMuda($idcatmuda)
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('jc.catpath AS pathfoto, j.imgfilename AS foto, j.imgtitle AS titulofoto');
        $query->from('#__joomgallery AS j');
        $query->join('', '#__joomgallery_catg AS jc ON j.catid = jc.cid');
        $query->where('j.catid = ' . $idcatmuda);
        $query->order('j.ordering');
        $db->setQuery($query);

        $item = $db->loadObjectList();

        return $item;
    }
    
}