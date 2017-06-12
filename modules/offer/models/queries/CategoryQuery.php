<?php

namespace app\modules\offer\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\Category]].
 *
 * @see \app\modules\offer\models\Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[active]]=1');
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
