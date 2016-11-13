<?php
/* @var $this yii\web\View */

$this->title = 'Каталог';
?>
<div class="row">
    <span id="prodId" data-id="<?=$product['id']?>" style="display: none;"></span>
    <div class="admin-content">
    
        <form class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control js-input-field" id="inputName" placeholder="Название" value="<?=$product['name']?>" data-field="name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputShortDescription" class="col-sm-2 control-label">Краткое описание</label>
                <div class="col-sm-10">
                    <textarea class="form-control js-input-field" id="inputShortDescription" data-field="short_description"><?=$product['description']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <textarea class="form-control js-input-field" id="inputDescription" data-field="description"><?=$product['description']?></textarea>
                </div>
            </div>
            <p class="col-sm-2 text-right" style="margin-left:-10px;"><b>Наличие:</b></p>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="head" class="js-in-stock" value="1" data-field="head_stock" <?=(($product['head_stock'] == 1)?'checked':'')?> >
                    <label for="head">Черенок</label>
                </div>
                <div class="col-sm-6">
                    <label for="headPrice">Цена</label>
                    <input type="number" id="headPrice" class="js-input-field" data-field="head_price" value="<?=$product['head_price']?>">
                </div>
            </div>
    
            <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="child" class="js-in-stock" value="1" data-field="child_stock" <?=(($product['child_stock'] == 1)?'checked':'')?>>
                    <label for="child">Детка</label>
                </div>
                <div class="col-sm-6">
                    <label for="childPrice">Цена</label>
                    <input type="number" id="childPrice" class="js-input-field" data-field="child_price" value="<?=$product['child_price']?>">
                </div>
            </div>
    
            <div class="form-group">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="plant" class="js-in-stock" value="1" data-field="stock" <?=(($product['stock'] == 1)?'checked':'')?>>
                    <label for="plant">Растение</label>
                </div>
                <div class="col-sm-6">
                    <label for="plantPrice">Цена</label>
                    <input type="number" id="plantPrice" class="js-input-field" data-field="price" value="<?=$product['price']?>">
                </div>
            </div>
    
            <div class="form-group js-images" style="padding-left: 15px; padding-right: 15px;">
                <div class="load-images-wrapper">
                <?php
                
                $photos = $product['photo'];
                if ($photos != null) {
                    $arrPhotos = explode(':', $photos);

                    foreach ($arrPhotos as $image) {
                        ?>
                        <div class="load-img">
                            <img src="/uploads/products/<?= $product['id'] ?>/<?= $image ?>">
                            <div class="delete"><span>&times;</span></div>
                        </div>
                        <?php
                    }
                }
                ?>
                </div>
                <div class="load-img button_add_img" data-id="add_img_input"></div>
            </div>
            <input type="file" style="display:none" id="add_img_input">
        </form>
        <div class="clearfix"></div>
    </div>
</div>
