<?php
$this->title = $product['name'];
/*$this->params['breadcrumbs'][] = array(
    'label' => 'Каталог',  // required
    'url' => '/catalog' );
$this->params['breadcrumbs'][] = $this->title;*/
$arrImages = explode(':', $product['photo']);
$arrImages = array_diff($arrImages, array(''));
$this -> registerMetaTag([
        'property' => 'og:image',
        'content' => 'http://test.kayuda-illustrations.ru/uploads/products/'.$product['id'].'/'.$arrImages[0],
]);
$this -> registerMetaTag([
        'property' => 'og:title',
        'content' => $this -> title,
]);
$this -> registerMetaTag([
        'property' => 'og:description',
        'content' => $product['description'],
]);
$this -> registerMetaTag([
        'property' => 'og:type',
        'content' => 'website',
]);
$childInStok = 0;
$headInStok = 0;
$inStok = 0;
$price = 0;
$childPrice = 0;
$headPrice = 0;

if ($product['child_price'] > 0)
    $childPrice = $product['child_price'];
if ($product['head_price'] != null)
    $headPrice = $product['head_price'];
if ($product['price'] > 0)
    $price = $product['price'];

$childInStok = $product['child_stock'];
$headInStok = $product['head_stock'];
$inStok = $product['stock'];


?>
<style>
    .fotorama__wrap {
        margin: 0 auto;
    }
    .name {
        margin-bottom: 20px;
    }
</style>
<div class="text-center">
    <div class="col-lg-8">
        <div class="fotorama" style=" max-width:100%; margin: 0 auto" data-nav="thumbs" data-transition="slide" data-allowfullscreen="true">
            <?php foreach ($arrImages as $image) {
                ?>
                <a href="/uploads/products/<?=$product['id']?>/<?=$image?>"></a>
                <?php
            }?>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="product-card">
            <p class="breadcrumbs ptserif">
                <a href="/catalog/">Каталог</a> <span class="grey-text">/</span>
                <?php if ($product['category_id'] != null) {?>
                    <a href="/catalog/<?=$product['category']['url']?>"><?=$product['category']['name']?></a> <span class="grey-text">/</span>
                    <a href="/catalog/<?=$product['category']['url']?>/<?=$product['subcategory']['url']?>" ><?=$product['subcategory']['name']?></a>
                <?php } ?>
                <?php if ($product['subsubcategory_id'] != null) {?>
                    <span class="grey-text">/</span>
                    <a href="/catalog/<?=$product['category']['url']?>/<?=$product['subcategory']['url']?>/<?=$product['subsubcategory']['url']?>" ><?=$product['subsubcategory']['name']?></a>
                <?php } ?>
            </p>
            <h1 class="name ptserif bold no-margin-top"><?=$product['name']?></h1>
            <?php if ($product['description'] != '' && $product['description'] != null) {?>
            <p class="product-description">
                <?=$product['description']?>
            </p>
            <?php } ?>
            <p class="ptserif bold" style="margin-bottom: 0; font-size: 16px;">Поделиться в соцсетях</p>
            <div class="likely likely-big">
                <div class="twitter"></div>
                <div class="facebook"></div>
                <div class="vkontakte"></div>
                <div class="odnoklassniki"></div>
            </div>
            <div class="prices" style="text-align: right">
                <?php if ($headInStok == 1) {?><p class="ptserif price" style="display: inline-block"><span class="type">Черенок: </span><span class="price"><?=number_format($headPrice, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$product['id']?>" data-type="head"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php } ?>
                <?php if ($childInStok == 1) {?><p class="ptserif price" style="display: inline-block"><span class="type">Детка: </span><span class="price"><?=number_format($childPrice, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$product['id']?>" data-type="child"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><br><?php } ?>
                <?php if ($inStok == 1) {?><p class="ptserif price" style="display: inline-block"><span class="type">Растение: </span><span class="price"><?=number_format($price, 0, ',', ' ' )?></span> <i class="fa fa-rub" aria-hidden="true"></i></p> <button class="btn btn-buy js-buy" data-product="<?=$product['id']?>" data-type="full"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Купить</button><?php } ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
