<?php

/* @var $this yii\web\View */

$this->title = 'Каталог';
?>

        <div class="text-right add-wrapper">
            <a href="/admin/catalog/new" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-plus"></span> Добавить</a>
        </div>
        <div class="col-md-12">
            <?php
            foreach($products as $item){
                echo '<div class="item"><a href="/admin/catalog/edit/'.$item['id'].'">'.$item['name'].'</a></div>';
            }
            
            ?>
            
        </div>
        <div class="clearfix"></div>

            