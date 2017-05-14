<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Eventlike]].
 *
 * @see Eventlike
 */
class EventlikeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Eventlike[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Eventlike|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
