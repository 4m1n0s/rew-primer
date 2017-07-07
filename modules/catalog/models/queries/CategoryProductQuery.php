<?php

namespace app\modules\catalog\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\catalog\models\CategoryProduct]].
 *
 * @see \app\modules\catalog\models\CategoryProduct
 */
class CategoryProductQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[active]]=1');
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\CategoryProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\CategoryProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
