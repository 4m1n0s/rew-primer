<?php

namespace app\modules\core\components;

/**
 * Class GlobalTexts
 * @package app\modules\core\components
 */
class GlobalTexts
{
    public function getFreePoints()
    {
        $freePointsAmount = intval(\Yii::$app->keyStorage->get('free_points_register'));

        if ($freePointsAmount > 0) {
            return \Yii::t('app', sprintf('sign up and get %d free points', $freePointsAmount));
        }

        return \Yii::t('app', 'sign up');
    }
}