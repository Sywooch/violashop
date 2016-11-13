<?php


namespace common\models;


use yii\db\ActiveRecord;
/**
 * Orders model
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $price
 * @property integer $count
 * @property string $type
 */
class OrderProducts extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'orders_products';
    }
    
    public function getOrder(){
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    public function getProduct(){
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}