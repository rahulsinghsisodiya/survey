<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property string $address
 * @property string $city
 * @property string $email
 * @property string $phone_number
 * @property string $shoe_size
 * @property string $jeans_size
 * @property string $shirt_size
 * @property string $blouse_size
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /** @inheritdoc */
    public function behaviors()
    {
        
        return [
            [
                'class' =>  TimestampBehavior::className(),
                'updatedAtAttribute' => 'created_at',
                'value' => date('Y-m-d H:i:s')
            ]
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'dob', 'address', 'city', 'email', 'phone_number', 'shoe_size', 'jeans_size', 'shirt_size', 'blouse_size',], 'required'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['address', 'status'], 'string'],
            [['first_name', 'last_name', 'city', 'email'], 'string', 'max' => 225],
            [['phone_number'], 'string', 'max' => 50],
            [['shoe_size', 'jeans_size', 'shirt_size', 'blouse_size'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'dob' => Yii::t('app', 'Dob'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'shoe_size' => Yii::t('app', 'Shoe Size'),
            'jeans_size' => Yii::t('app', 'Jeans Size'),
            'shirt_size' => Yii::t('app', 'Shirt Size'),
            'blouse_size' => Yii::t('app', 'Blouse Size'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
