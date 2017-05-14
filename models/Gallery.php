<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $gallery_id
 * @property integer $yearspanid
 * @property string $image
 * @property string $image_title
 * @property string $image_alt
 * @property integer $slider
 * @property string $created_date
 *
 * @property Yearspan $yearspan
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yearspanid'], 'required'],
            [['yearspanid', 'slider'], 'integer'],
            [['image'], 'string'],
            [['created_date'], 'safe'],
            [['image_title', 'image_alt'], 'string', 'max' => 45],
            [['yearspanid'], 'exist', 'skipOnError' => true, 'targetClass' => Yearspan::className(), 'targetAttribute' => ['yearspanid' => 'yearspanid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => 'Gallery ID',
            'yearspanid' => 'Yearspanid',
            'image' => 'Image',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
            'slider' => 'Slider',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearspan()
    {
        return $this->hasOne(Yearspan::className(), ['yearspanid' => 'yearspanid']);
    }

    /**
     * @inheritdoc
     * @return GalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GalleryQuery(get_called_class());
    }
}
