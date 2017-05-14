<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Eventcommentreply]].
 *
 * @see Eventcommentreply
 */
class EventcommentreplyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Eventcommentreply[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Eventcommentreply|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
