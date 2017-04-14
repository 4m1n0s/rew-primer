<?php

namespace app\modules\invitation\models\queries;
use app\modules\invitation\models\Invitation;

/**
 * This is the ActiveQuery class for [[\app\modules\invitation\models\Invitations]].
 *
 * @see \app\modules\invitation\models\Invitations
 */
class InvitationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\invitation\models\Invitation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\invitation\models\Invitation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $code
     * @return $this
     */
    public function code($code)
    {
        return $this->andWhere(['code' => $code]);
    }

    /**
     * @param $status
     * @return $this
     */
    public function status($status)
    {
        return $this->andWhere(['status' => $status]);
    }

    /**
     * @param $email
     * @return $this
     */
    public function email($email)
    {
        return $this->andWhere(['email' => $email]);
    }
}
