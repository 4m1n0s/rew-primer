<?php

namespace app\modules\contact\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\contact\models\Contact]].
 *
 * @see \app\modules\contact\models\Contact
 */
class ContactQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\contact\models\Contact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\contact\models\Contact|array|null
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
        return $this->andWhere(['status' => $status]);
    }
}
