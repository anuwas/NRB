<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "featuregallery".
 *
 * @property integer $featuregallery_id
 * @property string $image
 * @property string $image_title
 * @property string $image_alt
 * @property string $created_date
 */
class Featuregallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'featuregallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'string'],
            [['created_date'], 'safe'],
            [['image_title', 'image_alt'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'featuregallery_id' => 'Featuregallery ID',
            'image' => 'Image',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @inheritdoc
     * @return FeaturegalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeaturegalleryQuery(get_called_class());
    }
}
