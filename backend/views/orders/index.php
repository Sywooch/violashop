<?php

foreach ($orders as $order){
    ?>
    <?php if (!$order['viewed']){ ?>
        <i class="fa fa-circle" aria-hidden="true"></i>
        <?php  } else  { ?>
        <i class="fa fa-circle" aria-hidden="true" style="color:#fff"></i>
        <?php } ?>
        <a href="/admin/orders/<?=$order['id']?>">Заказ №<?=date('y')?>0<?=$order['id']?></a><br>
    <?php
}