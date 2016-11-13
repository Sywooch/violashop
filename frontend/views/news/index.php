<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="row">
        <?php
        foreach($news as $item){
            ?>
            <div class="col-lg-4">
                <?=$item['text']?>
            </div>
            <?php
        }
        ?>
    </div>
