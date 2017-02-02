<?php
/* @var $this yii\web\View */

$this->title = 'Каталог';
?>

    <span id="prodId" data-id="<?=$product['id']?>" style="display: none;"></span>

    
        <form class="form-horizontal">
            <div class="form-group my-inputs">
                <label for="inputName" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <div class="my-input my-input-medium">
                        <input type="text" class="my-input__input form-control js-input-field" id="inputName" placeholder="Название" value="<?=$product['name']?>" data-field="name">
                        <label for="inputName" class="my-input__label">&nbsp;</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Категория</label>
                <div class="col-sm-10">
                    <div class="my-select__select">
                        <select class="selectpicker">
                            <optgroup label="Новинки">
                                <option value="1">Новинки РС - Стандарты</option>
                                <option value="2">Новинки РС - Трейлеры</option>
                                <option value="3">Новинки РС - Мини</option>
                                <option value="4">Новинки РС - Стрептокарпусы</option>
                            </optgroup>
                            <optgroup label="Сорта РС">
                                <option value="5">Стандарты</option>
                                <option value="6">Трейлеры</option>
                                <option value="7">Мини</option>
                                <option value="8">Стрепсы</option>
                            </optgroup>
                            <optgroup label="Мини полумини">
                                <option value="9">Мини и полумини</option>
                            </optgroup>
                            <optgroup label="Стрепсы">
                                <option value="10">Стрептокарпусы</option>
                            </optgroup>
                            <optgroup label="Спецпредожения">
                                <option value="10">Спецпредлжение</option>
                            </optgroup>
                            
                        </select>
                    </div>
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
            <div class="form-group form-price">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="head" class="js-in-stock" value="1" data-field="head_stock" <?=(($product['head_stock'] == 1)?'checked':'')?> >
                    <label for="head">Черенок</label>
                </div>
                <div class="col-sm-6 my-inputs">
                    <label for="headPrice" class="my-inputs__label">Цена</label>
                    <div class="my-input my-input-small">
                        <input type="text" id="headPrice" class="my-input__input form-control js-input-field" data-field="head_price" value="<?=$product['head_price']?>">
                        <label for="headPrice" class="my-input__label">&nbsp;</label>
                        <span class="my-input__description">&#8381;</span>
                    </div>
                </div>
            </div>
    
            <div class="form-group form-price">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="child" class="js-in-stock" value="1" data-field="child_stock" <?=(($product['child_stock'] == 1)?'checked':'')?>>
                    <label for="child">Детка</label>
                </div>
                <div class="col-sm-6 my-inputs">
                    <label for="childPrice" class="my-inputs__label">Цена</label>
                    <div class="my-input my-input-small">
                        <input type="text" id="childPrice" class="my-input__input form-control js-input-field" data-field="child_price" value="<?=$product['child_price']?>">
                        <label for="childPrice" class="my-input__label">&nbsp;</label>
                        <span class="my-input__description">&#8381;</span>
                    </div>
                    
                </div>
            </div>
    
            <div class="form-group form-price">
                <div class="col-sm-2 col-sm-offset-2">
                    <input type="checkbox" id="plant" class="js-in-stock" value="1" data-field="stock" <?=(($product['stock'] == 1)?'checked':'')?>>
                    <label for="plant">Растение</label>
                </div>
                <div class="col-sm-6 my-inputs">
                    <label for="plantPrice" class="my-inputs__label">Цена</label>
                    <div class="my-input my-input-small">
                        <input type="text" id="plantPrice" class="my-input__input form-control js-input-field" data-field="price" value="<?=$product['price']?>">
                        <label for="plantPrice" class="my-input__label">&nbsp;</label>
                        <span class="my-input__description">&#8381;</span>
                    </div>
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

