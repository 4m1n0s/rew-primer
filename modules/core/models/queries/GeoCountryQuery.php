<?php

namespace app\modules\core\models\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\core\models\GeoCountry]].
 *
 * @see \app\modules\core\models\GeoCountry
 */
class GeoCountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\core\models\GeoCountry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\core\models\GeoCountry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
