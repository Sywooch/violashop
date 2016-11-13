<?php


namespace common\models;


use yii\db\ActiveRecord;
/**
 * Notify model
 * @property integer $id
 * @property boolean $notify
 * @property integer $order_id

 */

class Notify extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'notify';
    }
}