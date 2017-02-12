<?php $url = str_replace('/', '', Yii::$app -> request -> url);

foreach ($Menu as $item) {
    $pos = $url == str_replace('/','', $item['url']);
    ?>
    <li class="head-menu__menu-element <?=($pos !== false ) ? 'head-menu__menu-element-active' : ''?>"><a href="<?=$item['url']?>"><?=$item['name']?></a></li>
    <?php
}
