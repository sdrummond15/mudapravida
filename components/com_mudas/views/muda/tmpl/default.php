<?php
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');


$muda = $this->muda;
?>
<?php if (!empty($muda[0])) { ?>
    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mtel(v) {
            v = v.replace(/\D/g, "");             //Remove tudo o que não é dígito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id(el) {
            return document.getElementById(el);
        }
        window.onload = function () {
            id('telefone').onkeyup = function () {
                mascara(this, mtel);
            }
        }
    </script>


    <div class="result-mudas">

        <div class="detalhamento-muda">
            <div class="titulomuda">
                <?php echo '<h2>' . $muda[0]->name . '</h2>'; ?>
            </div>
            <div class="o-muda">

                <div>
                    <?php
                    if (!empty($muda[0]->descricao)) {
                        echo '<div class="desc-muda">' . $muda[0]->descricao . '</div>';
                    }

                    echo '<div class="end-muda">'
                    . '<h4>Endereço</h4>'
                    . '<p>' . $bairro . $muda[0]->cidade . ' | ' . $muda[0]->estado . '</p>'
                    . '</div>';
                    ?>
                </div>
            </div>

        </div>

        <div class="imagens-muda">
            <?php
            $fotos = MudasModelMuda::FotosMuda($muda[0]->album);
            foreach ($fotos as $foto) {
                $img = $foto->pathfoto . '/' . $foto->foto;
                $data = @getimagesize('images/joomgallery/details/' . $img);
                $width = $data[0];
                $height = $data[1];

                if ($height >= $width) {
                    $tamanho = 'background-size: 100% auto;';
                } else {
                    $tamanho = 'background-size: auto 100%;';
                }

                $backfoto = 'style="background: url(images/joomgallery/details/' . $img . ') no-repeat center;' . $tamanho . '"';
                ?>

                <a class="image-link" href="images/joomgallery/originals/<?php echo $img; ?>" data-lightbox="example-set" data-title="<?php echo $foto->titulofoto ?>" <?php echo $backfoto ?>></a>
            <?php }
            ?>
        </div>


      <?php
        if ((!empty($muda[0]->longitude)) && (!empty($muda[0]->latitude))) {

            echo '<div class="mapa-muda">';
            //$path = 'index.php?option=com_mudas';
            require_once JPATH_COMPONENT . '/includes/GoogleMap.php';
            require_once JPATH_COMPONENT . '/includes/JSMin.php';
            $MAP_OBJECT = new GoogleMapAPI();
            $MAP_OBJECT->_minify_js = isset($_REQUEST["min"]) ? FALSE : TRUE;
            $MAP_OBJECT->map_type = 'ROADMAP';
            $MAP_OBJECT->height = '200px';
            $MAP_OBJECT->width = '100%';
            $default_icon = JURI::base(true) . "/images/mark_muda.png";
            $default_icon_key = $MAP_OBJECT->setMarkerIcon($default_icon);
            $MAP_OBJECT->addMarkerByCoords($muda[0]->longitude, $muda[0]->latitude);
            ?>
            <?= $MAP_OBJECT->getHeaderJS(); ?>
            <?= $MAP_OBJECT->getMapJS(); ?>

            <?= $MAP_OBJECT->printOnLoad(); ?> 
            <?= $MAP_OBJECT->printMap(); ?>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtibuq-WR0XC5KJRpI-zsO0Cpt7omeFHc"></script>
            <?php
            echo '</div>';
        }
        ?>



        <?php
    } else {
        echo '<p class="alert-message">Muda não encontrada!</p>';
    }
    ?>

</div>

<script type="text/javascript" src="components/com_mudas/js/lightbox-plus-jquery.js"></script>
<script>
                    jQuery(function () {
                        jQuery('#map .gm-style').addClass('scrolloff');
                        jQuery('#map').on('click', function () {
                            jQuery('#map .gm-style').removeClass('scrolloff');
                        });
                        jQuery('#map').mouseleave(function () {
                            jQuery('#map .gm-style').addClass('scrolloff');
                        });
                    });
                    jQuery(function () {
                        jQuery(window).on('resize', function () {
                            var larguraimg = jQuery('.image-link').width();
                            jQuery('.image-link').css('height',larguraimg);
                        });
                    });

</script>