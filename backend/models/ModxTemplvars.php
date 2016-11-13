<?php

/**
 * User model
 *
 * @property integer $id
 * @property integer $tmplvarid
 * @property integer $contentid
 * @property string value
 */
namespace backend\models;


use yii\db\ActiveRecord;

class ModxTemplvars extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'modx_site_tmplvar_contentvalues';
    }
    
    
}