<?php

namespace app\modules\dashboard\helpers;

class TemplateHelper
{
    public static function indexPage($contentBlockName, $actionsBlockName = null)
    {
        return \Yii::$app->getView()->renderFile('@app/modules/dashboard/views/template/index.php', [
            'contentBlockName' => $contentBlockName,
            'actionsBlockName' => $actionsBlockName,
        ]);
    }

    public static function createPage($contentBlockName, $titleBlockName = null)
    {
        return \Yii::$app->getView()->renderFile('@app/modules/dashboard/views/template/create.php', [
            'contentBlockName' => $contentBlockName,
            'titleBlockName' => $titleBlockName
        ]);
    }

    public static function updatePage($contentBlockName, $titleBlockName = null)
    {
        return \Yii::$app->getView()->renderFile('@app/modules/dashboard/views/template/update.php', [
            'contentBlockName' => $contentBlockName,
            'titleBlockName' => $titleBlockName
        ]);
    }
}