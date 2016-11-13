<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron" style="padding-top: 0;">
        <h1 style="font-size: 40px;">Добро пожаловать!</h1>
        <p class="lead" style="font-size:18px">Рада привествовать всех любителей фиалочек!
            На нашем сайте вы можете ознакомиться с каталогом моих сортов фиалок и стрептокарпусов, посмотреть фотографии, увидеть новинки селекции.
            Я буду рада, если здесь Вы сможете подобрать и приобрести понравившиеся для себя сорта, будете выращивать и любить их.
            И я  уверенна, что они не останутся равнодушными и будут радовать Вас и Ваших друзей своими прекрасными цветами.</p>

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>
    <p style="font-size:16px; text-align:center">Последние добавленные новинки</p>
    <?php
    if ($products != null) {
        foreach ($products as $item) {
            ?>
            <div class="item col-lg-3 col-xs-12 col-sm-6 col-md-4" style="height: 350px;">
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
                <?php if ($item['category_id'] != null  && $item['subcategory_id'] != null ){?>
                    <a href="/catalog/<?=$item['category']['url']?>/<?=$item['subcategory']['url']?>/<?=$item['id']?>"><?=$item['name']?></a>
                <?php } else { ?>
                    <a href="/catalog/product/<?=$item['id']?>"><?=$item['name']?></a>
                <?php } ?>
<!--
                <br>
                <div class="prices" style="display: inline-block;text-align: right">
                    <?php /*if ($headInStok == 1 && $headPrice > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Черенок </span><span><?/*=number_format($headPrice, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="head"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php /*} */?>
                    <?php /*if ($childInStok == 1 && $childPrice > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Детка </span><span><?/*=number_format($childPrice, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="child"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php /*} */?>
                    <?php /*if ($inStok == 1 && $price > 0) {*/?><p class="ptserif price" style="display: inline-block"><span>Растение </span><span><?/*=number_format($price, 0, ',', ' ' )*/?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?/*=$item['id']*/?>" data-type="full"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><?php /*} */?>
                </div>-->
            </div>
            <?php
        }
        ?>
            <div class="clearfix"></div>
        <?php
    }
   /* var_dump($products);
    var_dump($lastDayLastMonth) ;
    var_dump($firstDayLastMonth) ;*/
    ?>
</div>
