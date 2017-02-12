<?php
/* @var $this yii\web\View */

?>
<?php $url = str_replace('/', '', Yii::$app -> request -> url);
$posCatalog = strpos($url, str_replace('/','', '/catalog/fialki/novinki-rs/standarty')) === false
    && strpos($url, str_replace('/','', '/catalog/fialki/novinki-rs/treilers')) === false
    && strpos($url, str_replace('/','', '/catalog/fialki/novinki-rs/mini')) === false
    && strpos($url, str_replace('/','', '/catalog/fialki/novinki-rs/streps')) === false
    && $url != 'catalog';
?>
<!--<li class="catalog-menu__item catalog-menu__item-parent js-menu-parent"><?/*=$subcategory[0]['name']*/?> <span class="caret"></span>
    <ul class="catalog-menu__child">
        <li class="catalog-menu__child-item"><a href="/catalog/fialki/novinki-rs/standarty">Стандарты</a></li>
        <li class="catalog-menu__child-item"><a href="/catalog/fialki/novinki-rs/treilers">Трейлеры</a></li>
        <li class="catalog-menu__child-item"><a href="/catalog/fialki/novinki-rs/mini">Мини</a></li>
        <li class="catalog-menu__child-item"><a href="/catalog/fialki/novinki-rs/streps">Стрептокарпусы</a></li>
    </ul>
</li>
<li class="catalog-menu__item"><a href="/catalog/fialki/sorta-rs-standarty">Сорта РС - стандарты</a></li>
<li class="catalog-menu__item"><a href="/catalog/fialki/sorta-rs-mini">Сорта РС - мини</a></li>
<li class="catalog-menu__item"><a href="/catalog/fialki/sorta-rs-treylery">Сорта РС - трейлеры</a></li>
<li class="catalog-menu__item">Стрептокарпусы</li>-->
<?php
    foreach ($subcategory as $menu) {
        $hasChild = false;
        foreach($subsubcategory as $submenu){
            if ($submenu['subcategory_id'] == $menu['id']) {
                $hasChild = true;
                break;
            }
        }
    ?>
        <li class="catalog-menu__item <?=$hasChild ? 'catalog-menu__item-parent js-menu-parent' : ''?> <?=$posCatalog !== false ? 'catalog-menu__item-active catalog-menu__item-open' : ''?> "><?=$hasChild ? $menu['name'] : ''?>
            <?php if ($hasChild) { ?><span class="caret"></span>
                <ul class="catalog-menu__child">
                    <?php foreach ($subsubcategory as $submenu) { ?>
                        <li class="catalog-menu__child-item"><a href="/catalog/fialki/<?=$menu['url']?>/<?=$submenu['url']?>"><?=$submenu['name']?></a></li>
                <?php } ?>
                   
                </ul>
            <?php } else { ?>
            <a href="/catalog/fialki/<?=$menu['url']?>"><?=$menu['name']?></a>
            <?php } ?></li>
    <?php
}
echo $url;