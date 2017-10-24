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
class GlobalSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    /*public $setting_name = [];
    public $setting_value = [];
    public $setting_type = [];*/
    public static function tableName()
    {
        return 'global_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_name', 'setting_value', 'setting_type'], 'required'],
            [['setting_name', 'setting_value', 'setting_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'setting_name' => Yii::t('app', 'Setting Name'),
            'setting_value' => Yii::t('app', 'Setting Value'),
            'setting_type' => Yii::t('app', 'Setting Type'),
        ];
    }
}
