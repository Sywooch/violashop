<?php
$count = 0;
foreach ($order['products'] as $item){
    $count += $item['count'];
}
?>
<div style="position:relative;float: right;margin-right: 20px;margin-top: 6px; text-align: center;">
    <a href="/order" class="full-block-link <?=($count==0 || Yii::$app -> controller -> id == 'order') ?'hidden':''?>" ></a>
<svg id="Слой_1" style="enable-background:new 0 0 512 512;    height: 35px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
        .st0{fill:none;stroke:#375E98;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
        .st0.empty{stroke:#333;}.st0.filled{fill:rgba(51,51,51,.2);stroke:#333;}
        .st1{fill:none;stroke:#375E98;stroke-width:27;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
        .st1.empty,.st1.filled{stroke:#333;}
    </style>
    <g>
        <path class="st0 <?=$count==0?'empty':''?> <?=Yii::$app -> controller -> id == 'order' ? 'filled' :''?>" d="M407.8,474.4H116.3c-18.6,0-34.6-13.4-37.7-31.8L32.1,172.5c-1.4-7.9,4.7-15.1,12.7-15.1h435.4   c8,0,14.1,7.2,12.7,15.1l-47.3,270.2C442.3,461.1,426.4,474.4,407.8,474.4z"/>
        <path class="st1 <?=$count==0?'empty':''?> <?=Yii::$app -> controller -> id == 'order' ? 'filled' :''?>" d="M136.5,187c0,0,17-159,119-159s120,159,120,159"/>
    </g>
</svg>
<span class="js-count" style="position: absolute;top: 12px;left: 0; right: 0;"><?=$count==0?'':$count?></span>
</div>
