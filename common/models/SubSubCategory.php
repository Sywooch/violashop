<?php


namespace common\models;


use yii\db\ActiveRecord;

class SubSubCategory extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'subsubcategory';
    }
    
    /**
     * @inheritdoc
     */
    public function getSubCategory(){
        return $this->hasOne(SubCategory::className(), ['id' => 'subcategory_id']);
    }
}