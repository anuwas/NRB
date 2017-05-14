<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contactus".
 *
 * @property integer $contactusid
 * @property string $fullname
 * @property string $emailid
 * @property string $phone_number
 * @property string $contat_message
 * @property string $created_date
 */
class Contactus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contactus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contat_message'], 'string'],
            [['created_date'], 'safe'],
            [['fullname', 'emailid'], 'string', 'max' => 145],
            [['phone_number'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contactusid' => 'Contactusid',
            'fullname' => 'Fullname',
            'emailid' => 'Emailid',
            'phone_number' => 'Phone Number',
            'contat_message' => 'Contat Message',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @inheritdoc
     * @return ContactusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactusQuery(get_called_class());
    }
}
