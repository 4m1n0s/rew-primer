<?php

namespace app\modules\core\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\core\models\RefTransactionOffer]].
 *
 * @see \app\modules\core\models\RefTransactionOffer
 */
class RefTransactionOfferQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RefTransactionOffer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RefTransactionOffer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $offerID
     * @param $leadID
     * @return $this
     */
    public function lead($offerID, $leadID)
    {
        return $this->andWhere(['offer_id' => $offerID, 'lead_id' => $leadID]);
    }
}
