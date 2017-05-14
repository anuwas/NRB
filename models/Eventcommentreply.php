<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventcommentreply".
 *
 * @property integer $eventcommentreplyid
 * @property integer $eventcommentid
 * @property integer $appuserid
 * @property integer $eventid
 * @property string $comment
 * @property string $created_date
 * @property integer $publish
 *
 * @property Eventcomment $eventcomment
 * @property Events $event
 * @property Appuser $appuser
 */
class Eventcommentreply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventcommentreply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventcommentid', 'appuserid', 'eventid'], 'required'],
            [['eventcommentid', 'appuserid', 'eventid','publish'], 'integer'],
            [['comment'], 'string'],
            [['created_date'], 'safe'],
            [['eventcommentid'], 'exist', 'skipOnError' => true, 'targetClass' => Eventcomment::className(), 'targetAttribute' => ['eventcommentid' => 'eventcommentid']],
            [['eventid'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['eventid' => 'eventid']],
            [['appuserid'], 'exist', 'skipOnError' => true, 'targetClass' => Appuser::className(), 'targetAttribute' => ['appuserid' => 'appuserid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventcommentreplyid' => 'Eventcommentreplyid',
            'eventcommentid' => 'Eventcommentid',
            'appuserid' => 'Appuserid',
            'eventid' => 'Eventid',
            'comment' => 'Comment',
            'created_date' => 'Created Date',
        	'publish' => 'Publish',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventcomment()
    {
        return $this->hasOne(Eventcomment::className(), ['eventcommentid' => 'eventcommentid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['eventid' => 'eventid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppuser()
    {
        return $this->hasOne(Appuser::className(), ['appuserid' => 'appuserid']);
    }

    /**
     * @inheritdoc
     * @return EventcommentreplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventcommentreplyQuery(get_called_class());
    }
}
