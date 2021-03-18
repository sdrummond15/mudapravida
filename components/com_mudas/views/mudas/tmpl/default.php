<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<div class="result-mudas">
    <?php
    foreach ($this->mudas as $mudas) {

        if (!empty($mudas->album)) {

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('j.imgfilename AS imgdest, j.imgtitle AS imagem, jc.catpath AS pasta');
            $query->from('#__joomgallery As j');
            $query->join('', '#__joomgallery_catg AS jc ON j.catid = jc.cid');
            $query->where('j.catid = ' . $mudas->album . ' AND j.featured = 1');
            $db->setQuery($query);
            $album = (array) $db->loadObjectList();

            if (!empty($album)) {
                $widthimage = getimagesize('images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest)[0];
                $heightimage = getimagesize('images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest)[1];
                if ($widthimage > $heightimage) {
                    $imagesize = 'imgheight';
                } else {                    
                    $imagesize = 'imgwidth';
                }
                $fotoimovel = 'style= "background: url(images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest . ') no-repeat; ' . $imagesize . '"';
            } else {
                $fotoimovel = 'style= "background: url(images/default_imovel.jpg) no-repeat"';
            }
        } else {
            $fotoimovel = 'style= "background: url(images/default_imovel.jpg) no-repeat"';
        }

        $link = 'index.php?option=com_mudas&view=muda&id=' . $mudas->imovel;
        
        ?>
        
        <div class="muda">
            <div class="muda-det">
                <pre><?php echo $mudas->fase; ?></pre>
                <a href="<?php echo $link; ?>" >
                    <div class="img-muda <?php echo $imagesize; ?>" <?php echo $fotoimovel; ?>>
                    </div>
                    <div class="titulo">
                        <h1><?php echo $mudas->titulo; ?></h1>
                    </div>
                </a>
                <div class="desc">
                    <?php echo $mudas->descricao; ?>
                    <a href="<?php echo $link; ?>" rel="Detalhe Mudas" class="detalhes">
                        Detalhes
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>



