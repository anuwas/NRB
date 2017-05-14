<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DBUser]].
 *
 * @see DBUser
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return DBUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DBUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
