<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Featuregallery]].
 *
 * @see Featuregallery
 */
class FeaturegalleryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Featuregallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Featuregallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
