<?php


namespace backend\models;


use yii\db\ActiveRecord;

class ModxContent extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'modx_site_content';
    }
    
    public function getImage(){
        return $this->hasMany(ModxTemplvars::className(), ['contentid' => 'id']);
    }
    
}