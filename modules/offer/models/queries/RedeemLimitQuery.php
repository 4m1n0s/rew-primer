<?php

namespace app\modules\offer\models\queries;
use app\modules\user\models\User;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\RedeemLimit]].
 *
 * @see \app\modules\offer\models\RedeemLimit
 */
class RedeemLimitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\RedeemLimit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\offer\models\RedeemLimit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $hours
     * @return $this
     */
    public function lastHours($hours = 24)
    {
        $now = date('Y-m-d H:i:s'); // Literal for DB caching
        return $this->andWhere(['>', 'created_at', new Expression('DATE_SUB("' . $now . '", INTERVAL ' . $hours . ' HOUR)')]);
    }

    /**
     * @param User $user
     * @return $this
     */
    public function user(User $user)
    {
        return $this->andWhere(['user_id' => $user->id]);
    }
}
