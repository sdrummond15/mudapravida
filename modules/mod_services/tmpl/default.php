<div id="modservices">
    <div id="services">

        <?php foreach ($services as $key => $service) : ?>
            <?php
            $key++;
            $link = JRoute::_('index.php?Itemid=' . $params->get('menu_catid' . $key));
            ?>
            <div class="service">
                <div class="item-service">
                    <a href="<?= $link; ?>" class="img-service">
                        <img src="<?= json_decode($service->params)->image ?>" alt="<?= $service->title; ?>">
                    </a>
                    <h1>
                        <a href="<?= $link; ?>"><?= $service->title; ?></a>
                    </h1>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>