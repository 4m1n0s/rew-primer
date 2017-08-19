<?php

namespace app\modules\catalog\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\catalog\models\RefProductGroupCategory]].
 *
 * @see \app\modules\catalog\models\RefProductGroupCategory
 */
class RefProductGroupCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\RefProductGroupCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\catalog\models\RefProductGroupCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
