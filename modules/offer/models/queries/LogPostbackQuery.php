<?php

namespace app\modules\offer\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\LogPostback]].
 *
 * @see \app\modules\offer\models\LogPostback
 */
class LogPostbackQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\LogPostback[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\LogPostback|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
