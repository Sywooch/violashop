<?php


namespace common\models;


use yii\db\ActiveRecord;
/**
 * Products model
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property integer $head_stock
 * @property integer $head_price
 * @property integer $child_stock
 * @property integer $child_price
 * @property integer $stock
 * @property integer $price
 * @property string $photo
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property integer $subsubcategory_id
 * @property boolean $nowelty
 * @property integer $createdon
 * @property integer $editedon
 */
class Products extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'products';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Product Name',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'head_stock' => 'Head in stock',
            'head_price' => 'Head price',
            'child_stock' => 'Child in stock',
            'child_price' => 'Child price',
            'stock' => 'Full in stock',
            'price' => 'Full price',
            'photo' => 'Photos',
            'category_id' => 'Category',
            'subcategory_id' => 'Subcategory',
            'subsubcategory_id' => 'Sub Subcategory',
            'nowelty' => 'Новинка',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function getSubcategory(){
        return $this->hasOne(SubCategory::className(), ['id' => 'subcategory_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function getSubsubcategory(){
        return $this->hasOne(SubSubCategory::className(), ['id' => 'subsubcategory_id']);
    }
    
}