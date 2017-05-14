<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventlike".
 *
 * @property integer $eventlikeid
 * @property integer $eventid
 * @property integer $appuserid
 * @property string $eventlikedate
 *
 * @property Appuser $appuser
 * @property Events $event
 */
class Eventlike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventlike';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventid', 'appuserid'], 'required'],
            [['eventid', 'appuserid'], 'integer'],
            [['eventlikedate'], 'safe'],
            [['appuserid'], 'exist', 'skipOnError' => true, 'targetClass' => Appuser::className(), 'targetAttribute' => ['appuserid' => 'appuserid']],
            [['eventid'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['eventid' => 'eventid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventlikeid' => 'Eventlikeid',
            'eventid' => 'Eventid',
            'appuserid' => 'Appuserid',
            'eventlikedate' => 'Eventlikedate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppuser()
    {
        return $this->hasOne(Appuser::className(), ['appuserid' => 'appuserid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['eventid' => 'eventid']);
    }

    /**
     * @inheritdoc
     * @return EventlikeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventlikeQuery(get_called_class());
    }
}
