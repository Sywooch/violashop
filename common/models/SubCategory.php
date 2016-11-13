<?php


namespace common\models;


use yii\db\ActiveRecord;

class SubCategory extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'subcategory';
    }
    
    /**
     * @inheritdoc
     */
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}