<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eventcomment".
 *
 * @property integer $eventcommentid
 * @property integer $appuserid
 * @property integer $eventid
 * @property string $comment
 * @property string $commentdate
 * @property integer $publish
 *
 * @property Appuser $appuser
 * @property Events $event
 * @property Eventcommentreply[] $eventcommentreplies
 */
class Eventcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eventcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appuserid', 'eventid'], 'required'],
            [['appuserid', 'eventid', 'publish'], 'integer'],
            [['comment'], 'string'],
            [['commentdate'], 'safe'],
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
            'eventcommentid' => 'Eventcommentid',
            'appuserid' => 'Appuserid',
            'eventid' => 'Eventid',
            'comment' => 'Comment',
            'commentdate' => 'Commentdate',
            'publish' => 'Publish',
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
     * @return \yii\db\ActiveQuery
     */
    public function getEventcommentreplies()
    {
        return $this->hasMany(Eventcommentreply::className(), ['eventcommentid' => 'eventcommentid']);
    }

    /**
     * @inheritdoc
     * @return EventcommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventcommentQuery(get_called_class());
    }
}
