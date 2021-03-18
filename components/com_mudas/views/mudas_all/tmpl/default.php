<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<div class="result-mudas">
    <h2>Resultados</h2>
    <?php
    foreach ($this->mudas_all as $mudas_all) {

        if (!empty($mudas_all->album)) {

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('j.imgfilename AS imgdest, j.imgtitle AS imagem, jc.catpath AS pasta');
            $query->from('#__joomgallery As j');
            $query->join('', '#__joomgallery_catg AS jc ON j.catid = jc.cid');
            $query->where('j.catid = ' . $mudas_all->album . ' AND j.featured = 1');
            $db->setQuery($query);
            $album = (array) $db->loadObjectList();

            if (!empty($album)) {
                $widthimage = getimagesize('images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest)[0];
                $heightimage = getimagesize('images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest)[1];
                if ($widthimage > $heightimage) {
                    $imagesize = 'background-size: auto 100%;';
                } else {
                    $imagesize = 'background-size: 100% auto;';
                }
                $fotoimovel = 'style= "background: url(images/joomgallery/originals/' . $album[0]->pasta . '/' . $album[0]->imgdest . ') no-repeat; ' . $imagesize . '"';
            } else {
                $fotoimovel = 'style= "background: url(images/default_imovel.jpg) no-repeat"';
            }
        } else {
            $fotoimovel = 'style= "background: url(images/default_imovel.jpg) no-repeat"';
        }

        $link = 'index.php?option=com_mudas&view=muda&id=' . $mudas_all->imovel;
        
        ?>
        
        <div class="muda">
            <div class="muda-det">
                <pre><?php echo $mudas_all->fase; ?></pre>
                <a href="<?php echo $link; ?>" >
                    <div class="img-muda" <?php echo $fotoimovel; ?>>
                    </div>
                    <div class="titulo">
                        <h1><?php echo $mudas_all->titulo; ?></h1>
                    </div>
                </a>
                <div class="desc">
                    <?php echo $mudas_all->descricao; ?>
                    <a href="<?php echo $link; ?>" rel="Detalhe Imovel Skalla" class="detalhes">
                        Detalhes
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>



