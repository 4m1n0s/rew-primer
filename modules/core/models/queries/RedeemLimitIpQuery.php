<?php

namespace app\modules\core\models\queries;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[\app\modules\core\models\RedeemLimitIp]].
 *
 * @see \app\modules\core\models\RedeemLimitIp
 */
class RedeemLimitIpQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RedeemLimitIp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\RedeemLimitIp|array|null
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
     * @param $ip
     * @return $this
     */
    public function ip($ip)
    {
        return $this->andWhere(['ip' => $ip]);
    }
}
