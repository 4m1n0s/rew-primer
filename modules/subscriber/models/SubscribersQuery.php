<?php

namespace app\modules\subscriber\models;

/**
 * This is the ActiveQuery class for [[Subscriber]].
 *
 * @see Subscriber
 */
class SubscribersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Subscriber[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Subscriber|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}