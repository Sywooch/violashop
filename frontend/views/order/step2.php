<?php
$this -> title = 'Оформление заказа';
$countryCurrent = "RU";
$client = $order['client'];
?>
<div class="order-block">
    <div class="">
        <div class="col-md-4 col-lg-4" style="margin-bottom:25px;">
            <!--<p class="ptserif" style="font-size: 13px;"><a href="#">Профиль</a> / <a href="#">Мои заказы</a> /
                <a href="#">Заказ № <?/*=date('y'). '0' .$order['id']*/?></a>
            </p>-->
            <p class="ptserif bold order-number">
                Оформление заказа №<?=date('y'). '0' .$order['id']?>
            </p>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <div class="user-data-wrapper">
                <form class="form-horizontal" method="post" action="/order/confirm" id="orderform" autocomplete="off">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <div class="label-wrapper">
                            <label for="inputEmail" class="control-label">Эл. почта</label>
                        </div>
                        <div class="input-wrapper">
                            <input type="email" class="form-control" name="email" required id="inputEmail" placeholder="email@domain.com" value="<?=$client['email']?>" autocomplete="off">
                            <div class="bonus-subscribe" style="margin-top: 5px">
                                <input type="checkbox" id="bonuses" checked name="subscribeBonus" value="true">
                                <label for="bonuses" style="mar">Подписаться на рассылку об акциях и новостях  </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label-wrapper">
                            <label for="inputPhone" class="control-label">Телефон</label>
                        </div>
                        <div class="input-wrapper">
                            <input type="tel" name="phone" required class="form-control js-required" id="inputPhone" placeholder="<?=($countryCurrent == "RU")?'+7 555 555-55-55':''?>"  value="<?=$client['phone']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label-wrapper">
                            <label for="inputName" class="control-label">Имя и фамилия</label>
                        </div>
                        <div class="input-wrapper" style="position:relative;height: 26px;">
                            <input type="text" class="form-control" name="nickname" id="inputName" placeholder="Агата Кристи"  value="<?=$client['nickname']?>">
                            <p class="error_text" style="display:none; position: absolute; font-size: 12px;font-weight: 400;color: #e25e77;bottom: -18px;left: 20px;">Это не имя человека</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label-wrapper">
                            <label for="inputCountry" class="control-label">Страна</label>
                        </div>
                        <div class="input-wrapper">
                            <select id="inputCountry" name="country" class="chosen-select">
                               <!-- <option value="RU" <?/*=$order['country'] == 'Россия'?'selected':''*/?>>Россия</option>
                                <option value="UA" <?/*=$order['country'] == 'Украина'?'selected':''*/?>>Украина</option>-->
                                <?php //$countries = Helper::getAllCountries();
                                foreach($countries as $country){
                                    $code = $country['code'];
                                    ?>
                                    <option value="<?=$code?>" <?=($order['country'] == $country['name'])?'selected':''?>><?=$country['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <div class="label-wrapper">
                            <label for="inputCity" class="control-label">Город</label>
                        </div>
                        <div class="input-wrapper">
                            <select id="inputCity" style="float:left;" name="city" class="chosen-select">
                                <?php foreach($cities as $city) {
                                    ?>
                                        <option value="<?=$city['name']?>" <?=($order['city'] == $city['name'])?'selected':''?> ><?=$city['name']?></option>
                                    <?php
                                }?>
                        
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label-wrapper" >
                            <label for="inputAddress" class="control-label">Адрес</label>
                        </div>
                        <div class="input-wrapper" style="height:26px;">
                            <input type="text" class="form-control" name="address" id="inputAddress" placeholder="ул. Советская, д 1, к. 1, кв. 1" >
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:14px;">
                        <div class="label-wrapper">
                            <label for="inputComment" class="control-label">Пожелания</label>
                        </div>
                        <div class="input-wrapper">
                            <textarea id="inputComment" name="comment"><?=$order['comment']?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 32px;">
                        <div class="label-wrapper">
                            <label class="control-label">Оплата</label>
                        </div>
                        <div class="input-wrapper" style="padding-top:3px;">
                            <div class="js-ua js-pay" style="<?=$order['country'] != null && $order['country'] != 'Украина'?'display:none':''?>">
                                <input type="radio" name="paytype" id="privat" <?=($order['payment']=='1' || ($order['country'] != 'Россия' && ($order['payment'] != null || $order['payment'] == '')))?'checked':''?> value="1">
                                <label for="privat" class="custom" >Карта Приватбанка (Украина)</label>
                                <!--<span style="font-family: HelveticaNeue, Helvetica, sans-serif;margin-left:5px;font-size: 12px;font-weight: 400;color: rgba(0, 0, 0, 0.5);">Visa, MasterCard</span>-->
                                <br>
                            </div>
                            <div class="js-ru js-pay" style="<?=$order['country'] == null || $order['country'] == 'Россия'?'':'display:none'?>">
                                <input type="radio" name="paytype" id="sber" value="2" <?=($order['payment']=='2'|| $order['payment'] == null || (($order['country'] == 'Россия' || $order['country'] == null) && ($order['payment'] == null || $order['payment'] == '')))?'checked':''?>>
                                <label for="sber" class="custom" >Карта Сбербанка (Россия)</label>
                                <br>
                            </div>
                            <div class="js-ru js-pay" style="<?=$order['country'] == null || $order['country'] == 'Россия'?'':'display:none'?>">
                                <input type="radio" name="paytype" id="alfa" value="3" <?=($order['payment']=='3')?'checked':''?>>
                                <label for="alfa" class="custom" >Карта Альфа-банка (Россия)</label>
                                <br>
                            </div>
                            <input type="radio" name="paytype" id="western" value="4" <?=($order['payment']=='4')?'checked':''?>>
                            <label for="western" class="custom" >Western Union</label>
                            <br>
                            <input type="radio" name="paytype" id="webmoney" value="5" <?=($order['payment']=='5' || ($order['country'] != 'Россия' && $order['country'] != 'Украина'))?'checked':''?>>
                            <label for="webmoney" class="custom" >WebMoney</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label-wrapper"></div>
                        <div class="input-wrapper">
                            <button type="submit" class="btn btn-buy js-submit" style="float:left;height: 32px;" form="orderform">Оформить заказ</button>
                        </div>
                    </div>
                    <input type="hidden" name="hash" value="<?=$order['order_hash']?>" id="order-hash">
                    <input type="hidden" name="countryForPay" value="<?=$countryCurrent?>" id="countryHidden">
                    <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-4 hidden-xs hidden-sm">
            <div class="delivery-srv">
                <p>тут можно описать условия покупки и оплаты</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>