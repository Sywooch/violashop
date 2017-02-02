<?php

/* @var $this yii\web\View */

$this->title = 'Каталог';
?>
<div class="categories">
    <ul class="category">
        <li class="category__name">Новинки
            <ul class="category__item">
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                
            </ul>
        </li>

        <li class="category__name">Новинки
            <ul class="category__item">
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>

            </ul>
        </li>

        <li class="category__name">Новинки
            <ul class="category__item">
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>

            </ul>
        </li>

        <li class="category__name">Новинки
            <ul class="category__item">
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>
                <li>
                    Стандарты
                </li>

            </ul>
        </li>
        
    </ul>
</div>

        <div class="text-right add-wrapper">
            <a href="/admin/catalog/new" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-plus"></span> Добавить</a>
        </div>
        <div class="col-md-12 catalog-items">
            <?php
            foreach($products as $item){
                echo '<div class="catalog-item"><a href="/admin/catalog/edit/'.$item['id'].'">'.$item['name'].'</a></div>';
            }
            
            ?>
            
        </div>
        <div class="clearfix"></div>

            