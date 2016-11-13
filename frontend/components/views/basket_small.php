<?php
$count = 0;
foreach ($order['products'] as $item){
    $count += $item['count'];
}
?>
<div class="basket fixed <?=$count==0 ?'empty':''?>">
    <a href="/order" class="full-block-link <?=$count==0 ?'hidden':''?>"></a>
    <div style="font-size:24px;min-height:1px;width: 35px;text-align: center;margin-left: 7px;display: inline-block;color:#fff"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
    <div style="display: inline-block;margin-left: 13px;color:#fff;"><a href="/order" class="basket-link"><span>В корзине</span></a> <span class="basket-count"><?=$count?></span> <span class="true-word"><?=\app\components\Helper::getCountProducts($count)?></span></div>
</div>
