<?php

namespace app\modules\core\models\queries;
use yii\web\IdentityInterface;

/**
 * This is the ActiveQuery class for [[\app\modules\offer\models\Transaction]].
 *
 * @see \app\modules\offer\models\Transaction
 */
class TransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\core\models\Transaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\Transaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    /**
     * @param IdentityInterface $user
     * @return $this
     */
    public function user(IdentityInterface $user)
    {
        return $this->andWhere(['user_id' => $user->getId()]);
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        return $this->andWhere(['type' => $type]);
    }
}
