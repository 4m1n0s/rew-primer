<?php

namespace app\modules\offer\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\CategoryOffer]].
 *
 * @see \app\modules\offer\models\CategoryOffer
 */
class CategoryOfferQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\CategoryOffer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\CategoryOffer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
