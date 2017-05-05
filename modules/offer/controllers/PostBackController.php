<?php

namespace app\modules\offer\controllers;

use app\modules\core\components\controllers\Controller;
use app\modules\offer\controllers\postbacks\AdWorkMedia;

class PostBackController extends Controller
{
    public function actions()
    {
        return [
            'adworkmedia' => [
                'class' => AdWorkMedia::class
            ],
        ];
    }
}
