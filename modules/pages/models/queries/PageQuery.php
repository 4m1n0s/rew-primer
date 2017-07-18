<?php

namespace app\modules\pages\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\pages\models\Page]].
 *
 * @see \app\modules\pages\models\Page
 */
class PageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\pages\models\Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\pages\models\Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $template
     * @return $this
     */
    public function template($template)
    {
        return $this->andWhere(['template' => $template]);
    }
}
