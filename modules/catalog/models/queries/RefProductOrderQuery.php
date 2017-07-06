<?php

namespace app\modules\catalog\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\catalog\models\RefProductOrder]].
 *
 * @see \app\modules\catalog\models\RefProductOrder
 */
class RefProductOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\RefProductOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\RefProductOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
