<?php

namespace app\modules\offer\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\Transaction]].
 *
 * @see \app\modules\offer\models\Transaction
 */
class TransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Transaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Transaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $externalID
     * @param $objectType
     * @return $this
     */
    public function lead($externalID, $objectType)
    {
        return $this->andWhere(['object_type' => $objectType, 'external_transaction_id' => $externalID]);
    }
}
