<?php

namespace app\modules\catalog\models\queries;
use app\modules\catalog\models\Product;

/**
 * This is the ActiveQuery class for [[\app\modules\catalog\models\Product]].
 *
 * @see \app\modules\catalog\models\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function inStock()
    {
        return $this->andWhere(['status' => Product::IN_STOCK]);
    }
}
