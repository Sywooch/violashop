<?php

/* @var $this yii\web\View */

$this->title = 'Каталог';
//$this->params['breadcrumbs'][] = $this->title;
$price = 0;
$childPrice = 0;
$headPrice = 0;

$childInStok = 0;
$headInStok = 0;
$inStok = 0;
?>
<div class="col-lg-3 col-md-3">
    <ul class="catalog-menu__main" data-spy="affix" data-offset-top="295">
        <li class="catalog-menu__item catalog-menu__item-parent js-menu-parent">Новинки РС <span class="caret"></span>
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
        <li class="catalog-menu__item">Стрептокарпусы</li>
    </ul>
</div>
<div class="col-lg-9 col-xs-12 col-sm-12 col-md-9 " style="padding-right: 5px;padding-left: 5px;">
    <div class="ias-catalog">
    <?php foreach($products as $item){
        if ($item['child_price'] > 0)
            $childPrice = $item['child_price'];
        if ($item['head_price'] != null)
            $headPrice = $item['head_price'];
        if ($item['price'] > 0)
            $price = $item['price'];
        
        $childInStok = $item['child_stock'];
        $headInStok = $item['head_stock'];
        $inStok = $item['stock'];
        
        
        ?>
        <div class="item ias-item">
            <div class="card">
                <?php if ($item['category_id'] != null  && $item['subcategory_id'] != null ){?>
                    <a href="/catalog/<?=$item['category']['url']?>/<?=$item['subcategory']['url']?>/<?=$item['id']?>"><?=$item['name']?></a>
                <?php } else { ?>
                    <a href="/catalog/product/<?=$item['id']?>"><?=$item['name']?></a>
                <?php } ?>
                <div class="img">
                    <?php if ($item['category_id'] != null  && $item['subcategory_id'] != null ){?>
                    <a href="/catalog/<?=$item['category']['url']?>/<?=$item['subcategory']['url']?>/<?=$item['id']?>" class="non full-block-link"></a>
                    <?php } else { ?>
                        <a href="/catalog/product/<?=$item['id']?>" class="non full-block-link"></a>
                    <?php } ?>
                    <?php if (\app\components\Helper::startsWith($item['photo'], 'http')) {?>
                    <img src="<?=$item['photo']?>">
                     <?php } else { if ($item['photo'] != null && $item['photo'] != '') {?>
                    <img src="/uploads/products/<?=$item['id']?>/<?=explode(':', $item['photo'])[0]?>">
                    <?php  }else {?>
                    <img src="/images/no_img.jpg">
                    <?php }}?>
                
                    <?php if ($item['short_description'] != null || $item['short_description'] != '') {?>
                    <div class="description">
                        <p><?=$item['short_description']?></p>
                    </div>
                    <?php }?>
                    <div class="labels-wrapper">
                        <?php if ($item['nowelty'] == 1) {?>
                                <div class="labels novielty"><span>Новинка</span></div>
                        <?php } ?>
                    </div>
                </div>
                <br>
                <div class="buttons-stock">
                <div class="prices" style="display: inline-block;text-align: right">
                    <?php if ($headInStok == 1 && $headPrice > 0) {?><p class="ptserif price" style="display: inline-block"><span>Черенок </span><span><?=number_format($headPrice, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$item['id']?>" data-type="head"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php } ?>
                    <?php if ($childInStok == 1 && $childPrice > 0) {?><p class="ptserif price" style="display: inline-block"><span>Детка </span><span><?=number_format($childPrice, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$item['id']?>" data-type="child"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php } ?>
                    <?php if ($inStok == 1 && $price > 0) {?><p class="ptserif price" style="display: inline-block"><span>Растение </span><span><?=number_format($price, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$item['id']?>" data-type="full"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><?php } ?>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</div>
<div id="pagination" style="display:none;">
<?php
if (isset($pages)) {
    echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
    ]);
}
    ?>
</div>
<script>
    
</script>