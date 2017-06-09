<?php

namespace app\modules\offer\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\Offer]].
 *
 * @see \app\modules\offer\models\Offer
 */
class OfferQuery extends \yii\db\ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere('[[active]]=1');
    }

    /**
     * @param $id
     * @return $this
     */
    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Offer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Offer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
