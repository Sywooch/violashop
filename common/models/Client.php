<?php


namespace common\models;


use yii\db\ActiveRecord;
/**
 * Orders model
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $city
 * @property string $country
 * @property string $nickname
 * @property boolean $subscribe
 */
class Client extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'clients';
    }
}