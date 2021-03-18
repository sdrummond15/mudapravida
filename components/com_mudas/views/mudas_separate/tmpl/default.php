<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<div class="result-mudas">
    <?php
    foreach ($this->mudas_separate as $mudas_separate) {

        if (!empty($mudas_separate->album)) {

            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('j.imgfilename AS imgdest, j.imgtitle AS imagem, jc.catpath AS pasta');
            $query->from('#__joomgallery As j');
            $query->join('', '#__joomgallery_catg AS jc ON j.catid = jc.cid');
            $query->where('j.catid = ' . $mudas_separate->album . ' AND j.featured = 1');
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

        $link = 'index.php?option=com_mudas&view=muda&id=' . $mudas_separate->imovel;
        ?>
        <h2></h2>
        <div class="muda">
            <div class="muda-det">
                <pre>
                    <?php if ($mudas_separate->fase == 'Nenhum') { 
                                    echo 'À Venda';                                        
                                }else{
                                    echo $mudas_separate->fase;
                                }
                            ?>
                </pre>
                <a href="<?php echo $link; ?>" >
                    <div class="img-muda" <?php echo $fotoimovel; ?>>
                    </div>
                    <div class="titulo">
                        <h1><?php echo $mudas_separate->titulo; ?></h1>
                    </div>
                </a>
                <div class="desc">
                    <?php echo $mudas_separate->descricao; ?>
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



