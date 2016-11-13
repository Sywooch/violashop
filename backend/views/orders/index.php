<?php

foreach ($orders as $order){
    ?>
    <?php if (!$order['viewed']){ ?>
        <i class="fa fa-certificate" aria-hidden="true"></i>
        <?php  } ?>
        <a href="/admin/orders/<?=$order['id']?>">Заказ №<?=date('y')?>0<?=$order['id']?></a><br>
    <?php
}