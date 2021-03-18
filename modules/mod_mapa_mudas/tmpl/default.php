<?php

$MAP_OBJECT = new GoogleMapAPI();
$MAP_OBJECT->_minify_js = isset($_REQUEST["min"]) ? FALSE : TRUE;
$MAP_OBJECT->map_type = 'ROADMAP';
$MAP_OBJECT->width = '100%';
$MAP_OBJECT->height = '450px';
$default_icon = JURI::base(true) . "/images/mark_muda.png";
$default_icon_key = $MAP_OBJECT->setMarkerIcon($default_icon);
echo '<div id="blockmap"></div>';
foreach ($mapa_mudas as $row) {

    $link = 'index.php?option=com_mudas&view=muda&id=' . $row->id;

    $det_imovel = '<h3>' . $row->name . '</h3>
                   <a href="' . $link . '">Detalhes</a>';

    if (!empty($row->longitude) && (!empty($row->latitude))) {
        $MAP_OBJECT->addMarkerByCoords($row->longitude, $row->latitude, $row->name, $det_imovel);
    }
}
?>
<?= $MAP_OBJECT->getHeaderJS(); ?>
<?= $MAP_OBJECT->getMapJS(); ?>

<?= $MAP_OBJECT->printOnLoad(); ?> 
<?= $MAP_OBJECT->printMap(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtibuq-WR0XC5KJRpI-zsO0Cpt7omeFHc"></script>