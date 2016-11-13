<?php


namespace common\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'category';
    }
}