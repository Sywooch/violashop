<?php


namespace frontend\models;


use yii\db\ActiveRecord;
/**
 * Orders model
 * @property integer $country_id
 * @property integer $city_id
 * @property string $name
 * @property integer $region_id
 */
class City extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'city';
    }
    
    
    public function getCity(){
        return $this->hasOne(City::className(), ['country_id' => 'country_id']);
    }
}