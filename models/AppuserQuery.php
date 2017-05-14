<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Appuser]].
 *
 * @see Appuser
 */
class AppuserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Appuser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Appuser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
