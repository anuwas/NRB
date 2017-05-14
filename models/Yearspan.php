<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yearspan".
 *
 * @property integer $yearspanid
 * @property integer $year_start
 * @property integer $year_end
 * @property string $created_date
 *
 * @property Gallery[] $galleries
 */
class Yearspan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yearspan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_start', 'year_end'], 'required'],
            [['year_start', 'year_end'], 'integer'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'yearspanid' => 'Yearspanid',
            'year_start' => 'Year Start',
            'year_end' => 'Year End',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['yearspanid' => 'yearspanid']);
    }

    /**
     * @inheritdoc
     * @return YearspanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new YearspanQuery(get_called_class());
    }
}
