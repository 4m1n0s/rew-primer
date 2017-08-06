<?php

namespace app\modules\core\components\log;

use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\log\DbTarget;

class DbTargetPostback extends DbTarget
{
    public $logTable = '{{%log_postback}}';

    /**
     * Stores log messages to DB.
     */
    public function export()
    {
        echo $tableName = $this->db->quoteTableName($this->logTable);
        $sql = "INSERT INTO $tableName ([[level]], [[category]], [[offer_id]], [[prefix]], [[message]], [[log_vars]], [[log_time]])
                VALUES (:level, :category, :offer_id, :prefix, :message, :log_vars, :log_time)";
        $command = $this->db->createCommand($sql);
        foreach ($this->messages as $message) {
            list($text, $level, $category, $timestamp) = $message;
            if (is_array($text)) {
                $offerID = !empty($text['offer_id']) ? $text['offer_id'] : null;
                $text = !empty($text['message']) ? $text['message'] : null;
            } elseif (!is_string($text)) {
                // exceptions may not be serializable if in the call stack somewhere is a Closure
                if ($text instanceof \Throwable || $text instanceof \Exception) {
                    $text = (string) $text;
                } else {
                    $text = VarDumper::export($text);
                }
            }
            $command->bindValues([
                ':level' => $level,
                ':category' => $category,
                ':offer_id' => !empty($offerID) ? $offerID: null,
                ':prefix' => $this->getMessagePrefix($message),
                ':message' => $text,
                ':log_vars' => $this->getVars(),
                ':log_time' => $timestamp,
            ])->execute();
        }
    }

    protected function getVars()
    {
        $vars = ['_GET', '_POST', '_COOKIE', '_SESSION', '_SERVER'];
        $context = ArrayHelper::filter($GLOBALS, $vars);
        $result = [];
        foreach ($context as $key => $value) {
            $result[] = "\${$key} = " . VarDumper::dumpAsString($value);
        }
        return implode("\n\n", $result);
    }
}