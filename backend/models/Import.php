<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "global_settings".
 *
 * @property integer $id
 * @property string $setting_name
 * @property string $setting_value
 * @property string $setting_type
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    /*public $setting_name = [];
    public $setting_value = [];
    public $setting_type = [];*/
  
    /**
     * @inheritdoc
     */
    public $name;
    public $file;
    public function rules()
    {
        return [
            [['name', 'file'], 'required'],
             [['file'], 'file','extensions' => 'csv'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'file' => Yii::t('app', 'File'),
           
        ];
    }
}
