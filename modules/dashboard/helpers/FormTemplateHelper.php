<?php

namespace app\modules\dashboard\helpers;

class FormTemplateHelper
{
    public static function baseFieldConfig()
    {
        return [
            'template' => "<div class='col-xs-12'><div class=\"form-group\">{label}<div class=\"col-md-4\">{input}{error}</div></div></div>",
            'labelOptions' => ['class' => 'col-md-3 control-label'],
            'inputOptions' => [
                'class' => 'form-control',
            ]
        ];
    }
}