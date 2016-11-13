<div id="products">
<?php
use app\components\Helper;

if ($products == null){
    echo 'Ничего не найдено';
}
else
foreach ($products as $product) { ?>

    <div class="text-left no-padding-left" style="margin-bottom: 15px; float:left; position:relative;width:100%">
    <?php if ($product['category_id'] != null  && $product['subcategory_id'] != null ){?>
        <a href="/catalog/<?=$product['category']['url']?>/<?=$product['subcategory']['url']?>/<?=$product['id']?>">
            <?php if (substr( $product['photo'], 0, 4 ) !== "http") { ?>
                <img src="/uploads/products/<?=$product['id']?>/<?=explode(':', $product['photo'])[0]?>" style="width: 120px;">
            <?php } else { ?>
                <img src="<?=$product['photo']?>" style="width: 120px;">
            <?php } ?>
        </a>
    <?php } ?>
        <span class="searchname" style="margin-left:24px; float:left; font-size:14px">
    <?php if ($product['category_id'] != null  && $product['subcategory_id'] != null ){?>
                                    <a href="/catalog/<?=$product['category']['url']?>/<?=$product['subcategory']['url']?>/<?=$product['id']?>"><?=$product['name']?></a>
    <?php } ?>
                                    </span>
        
        <div class="fade"></div>
    </div>
    <div class="clearfix"></div>

<?php } ?>
</div>