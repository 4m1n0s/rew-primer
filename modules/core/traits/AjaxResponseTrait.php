<?php

namespace app\modules\core\traits;

use yii\helpers\Json;

trait AjaxResponseTrait
{
    protected function sendAjaxResponse($status = 1, $message = '', $data = [])
    {
        $response = ['status' => $status, 'message' => $message, 'data' => $data];
        return Json::encode($response);
    }
}