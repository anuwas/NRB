<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Eventcomment]].
 *
 * @see Eventcomment
 */
class EventcommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Eventcomment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Eventcomment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
