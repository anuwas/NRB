<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appuser".
 *
 * @property integer $appuserid
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property integer $status
 * @property string $create_date
 */
class Appuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['create_date'], 'safe'],
            [['username', 'email', 'password'], 'string', 'max' => 145],
            [['phone'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appuserid' => 'Appuserid',
            'username' => 'Username',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'status' => 'Status',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @inheritdoc
     * @return AppuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppuserQuery(get_called_class());
    }
}
