<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Yearspan]].
 *
 * @see Yearspan
 */
class YearspanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Yearspan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Yearspan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
