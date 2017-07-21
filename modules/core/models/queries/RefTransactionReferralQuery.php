<?php

namespace app\modules\core\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\core\models\RefTransactionReferral]].
 *
 * @see \app\modules\core\models\RefTransactionReferral
 */
class RefTransactionReferralQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RefTransactionReferral[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RefTransactionReferral|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
