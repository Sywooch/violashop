<?php
$this -> title = 'Ваш заказ';
$products = $order['products'];
?>
<div class="basket-wrapper">
    <div class="col-lg-7" style="padding-top:8px;margin-bottom: 13px;">
       <!-- <p class="ptserif" style="font-size: 13px;"><a href="#">Профиль</a> / <a href="#">Мои заказы</a> /</p>-->
        <div class="order_head">
            <p class="ptserif bold order-head" style="">Ваш заказ №<?=date('y').'0'. $order['id']?></p>
            <p style="width: 235px; padding-left:10px; padding-right:10px;" class="hidden-xs hidden-sm hidden-md">Количество</p>
            <p style="width:87px; text-align:right;" class="hidden-xs hidden-sm hidden-md">Цена</p>
        </div>

    </div>
    <div class="clearfix"></div>
<?php
foreach($products as $p){
    $arrPhotos = explode(':',$p['product']['photo']);
    $arrPhotos = array_diff($arrPhotos, array(''));
    $price = $p['price'];
    $product = $p['product'];
    ?>
        <div class="cart-item col-lg-7" data-price="<?=$price?>" data-count="<?=$p['count']?>">
            <input type="hidden" class="js-data-count" value="<?=$p['count']?>">
            <div class="item-photo">
                <a href="/catalog/product/<?=$p['product']['id']?>" class="non">
                    <?php if ($p['product']['photo'] != null) { ?>
                        <img src="/uploads/products/<?=$p['product']['id']?>/<?=$arrPhotos[0]?>">
                    <?php } else { ?>
                        <img src="/images/no_img.jpg">
                    <?php } ?>
                </a>
            </div>
            <div class="item-text">
                <p style="font-size: 18px;font-weight: 400;margin-bottom:4px;" class="item-link">
                    <a href="/catalog/product/<?=$p['product']['id']?>"><?=$p['product']['name']?></a>
                </p>
                <p class="item-description">
                    <span class="item-description__name">Тип: </span>
                    <span class="item-description__value"><?=\common\models\Order::getProductType()[$p['type']]?></span>
                </p>
                <?php if (!\Yii::$app->params['devicedetect']['isDesktop']) {?>
                <div class="hidden-lg item-description" style="margin-top:5px;">
                    <p class="item-description__name" style="font-size: 12px;    margin-top: 5px; display:inline-block;width: 75px;margin-right: 20px;float:left">Количество</p>
                    <div class="count-wrapper" style="float:left"  data-count="<?=$p['count']?>">
                        <div class="count-minus"  data-field="count" data-id="<?=$p['id']?>" data-max="10">
                            <div class="icon-minus" style="<?=$p['count'] == 1?'opacity:0.3':''?>"></div>
                        </div>
                        <input type="number" class="item-count" value="<?=$p['count']?>" min="1" max="10" data-max="10">
                        <div class="count-plus" data-field="count" data-id="<?=$p['id']?>">
                            <div class="icon-plus" style="<?=$p['count'] == 10?'opacity:0.3':''?>"  data-max="10"></div>
                        </div>
                    </div>
                    <p class="error-text js-error">В наличии 10 штук</p>
                    <div class="clearfix"></div>
                </div>
                <?php } ?>
            </div>
            <?php
            if (!\Yii::$app -> deviceDetect -> isMobile() && !\Yii::$app -> deviceDetect -> isTablet()) {?>
            <div style="float:left;padding-top:10px;" class="hidden-xs hidden-sm hidden-md">
                <div class="count-wrapper" data-count="<?=$p['count']?>">
                    <div class="count-minus"  data-field="count" data-id="<?=$p['id']?>" data-max="10">
                        <div class="icon-minus" style="<?=$p['count'] == 1?'opacity:0.3':''?>"></div>
                    </div>
                    <input type="number" class="item-count" value="<?=$p['count']?>" min="1" max="10" data-max="10">
                    <div class="count-plus" data-field="count" data-id="<?=$p['id']?>">
                        <div class="icon-plus" style="<?=$p['count'] == 10?'opacity:0.3':''?>"  data-max="10"></div>
                    </div>
                </div>
                <p class="error-text js-error">В наличии 10 штук</p>
            </div>
            <?php } ?>
            <div style="float:right;padding-right:0;padding-top:12px;" class="hidden-xs hidden-sm hidden-md">
                <p style="font-family: HelveticaNeue, Helvetica, sans-serif;font-size: 18px;font-weight: 400;color:#333;"><?=number_format( $price, 0, ',', ' ' )?> <i class="fa fa-rub" aria-hidden="true"></i></p>
                <input type="hidden" name="price" value="<?=$price?>">
            </div>
           
            <div class="blank"></div>
            <div class="remove-item_wrapper"><div class="remove-item text-center js-remove-item" data-prod="<?=$p['product']['id']?>" data-url="/order/delete/<?=$p['id']?>" data-prid="<?=$p['id']?>"></div></div>
            <div class="remove-item-mobile hidden-lg"><div class="remove-item text-center js-remove-item" data-prod="<?=$p['product']['id']?>" data-url="/order/delete/<?php echo $p['id']?>" data-prid="<?=$p['id']?>"></div></div>
            <input type="hidden" class="js-item-count" value="<?=$p['count']?>">
            
    <?php
    //echo $p['product']['name']. ' -> ' . $p['count'] . ' * ' . $p['price'] . ' = ' . ($p['count'] * $p['price']) . \common\models\Order::getProductType()[$p['type']].'<br>';
?>
            <div class="clearfix"></div>
        </div>
    <?php
}
?>
    <div class="col-md-5 col-lg-4 pull-right confirm_block-wrapper" style="">
        <div class="confirm_block" style="max-width:100%;width:400px; max-width:100%;margin-bottom: 15px;">
            <p style="float:left">
                <span style="color: #999;font-size:12px;margin-right: 30px">Сумма заказа</span><br>
                <span class="ptserif bold" style="font-size:28px"><span class="total"><?=number_format($order['total'], '0', '.', ' ')?></span> <i class="fa fa-ruble" style="font-size: 18px"></i></span>
            </p>
            <a href="/order/step2" type="button" class="btn btn-buy " style="height: auto; padding-top: 5px; padding-bottom:5px; font-size: 24px; float:left; margin-top: 5px;">Оформить заказ</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
    <div class="clearfix"></div>

