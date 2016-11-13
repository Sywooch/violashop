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
        <div class="item col-lg-3 col-xs-12 col-sm-6 col-md-4 ias-item">
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
                <!--<div class="labels-wrapper">
                    <?php /*if ($item['subcategory_id'] == 1) {*/?>
                        <div class="labels novielty"><span>Новинка</span></div>
                    <?php /*} */?>
                </div>-->
            </div>
            <?php if ($item['category_id'] != null  && $item['subcategory_id'] != null ){?>
                <a href="/catalog/<?=$item['category']['url']?>/<?=$item['subcategory']['url']?>/<?=$item['id']?>"><?=$item['name']?></a>
            <?php } else { ?>
                <a href="/catalog/product/<?=$item['id']?>"><?=$item['name']?></a>
            <?php } ?>
            
            <!--<br>
            <div class="prices" style="display: inline-block;text-align: right">
                <?php /*if ($headInStok == 1 && $headPrice > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Черенок </span><span><?/*=number_format($headPrice, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="head"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php /*} */?>
                <?php /*if ($childInStok == 1 && $childPrice > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Детка </span><span><?/*=number_format($childPrice, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="child"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php /*} */?>
                <?php /*if ($inStok == 1 && $price > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Растение </span><span><?/*=number_format($price, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="full"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><?php /*} */?>
            </div>-->
        </div>
        <?php
    }
    ?>
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