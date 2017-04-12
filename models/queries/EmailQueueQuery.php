<?php

namespace app\models\queries;
use app\models\EmailQueue;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\EmailQueue]].
 *
 * @see \app\models\EmailQueue
 */
class EmailQueueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\EmailQueue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\EmailQueue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $status
     * @return $this
     */
    public function status($status)
    {
        return $this->andWhere([EmailQueue::tableName() . '.status' => $status]);
    }
}
