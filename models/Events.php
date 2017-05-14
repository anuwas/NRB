<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $eventid
 * @property integer $user_id
 * @property string $event_name
 * @property string $event_date
 * @property string $event_image
 * @property integer $event_status
 * @property integer $total_like
 * @property integer $total_comment
 * @property string $event_created_date
 *
 * @property Eventcomment[] $eventcomments
 * @property Eventcommentreply[] $eventcommentreplies
 * @property Eventlike[] $eventlikes
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'event_status', 'total_like', 'total_comment'], 'integer'],
            [['event_date', 'event_created_date'], 'safe'],
            [['event_image'], 'string'],
            [['event_name'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventid' => 'Eventid',
            'user_id' => 'User ID',
            'event_name' => 'Event Name',
            'event_date' => 'Event Date',
            'event_image' => 'Event Image',
            'event_status' => 'Event Status',
            'total_like' => 'Total Like',
            'total_comment' => 'Total Comment',
            'event_created_date' => 'Event Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventcomments()
    {
        return $this->hasMany(Eventcomment::className(), ['eventid' => 'eventid']);
    }
    
    public function getEventcommentsuser()
    {
    	return $this->hasMany(Eventcomment::className(), ['eventid' => 'eventid'])->with('appuser');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventcommentreplies()
    {
        return $this->hasMany(Eventcommentreply::className(), ['eventid' => 'eventid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventlikes()
    {
        return $this->hasMany(Eventlike::className(), ['eventid' => 'eventid']);
    }
    
    public function getEventlikesuser()
    {
    	return $this->hasMany(Eventlike::className(), ['eventid' => 'eventid'])->with('appuser');
    }

    /**
     * @inheritdoc
     * @return EventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventsQuery(get_called_class());
    }
}
