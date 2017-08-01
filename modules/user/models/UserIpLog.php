<?php

namespace app\modules\user\models;

use app\modules\core\components\tasks\RiskScoreJob;
use Yii;
use yii\base\ErrorException;

/**
 * This is the model class for table "{{%user_ip_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $risk_score
 *
 * @property User $user
 */
class UserIpLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_ip_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['risk_score', 'number', 'min' => '0', 'max' => '99.9'],
            [['user_id', 'ip'], 'required'],
            [['user_id'], 'integer'],
            [['ip'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @param $userID
     * @param $userIP
     * @return bool
     */
    public static function add($userID, $userIP)
    {
        try {
            /* @var UserIpLog $model */
            if (($model = self::find()->where(['user_id' => $userID, 'ip' => $userIP])->one())) {
                if ($model->risk_score == 0 && (floatval(Yii::$app->keyStorage->get('security.risk_score')) > 0)) {
                    Yii::$app->queue->push(new RiskScoreJob([
                        'ipLogModelID' => $model->id
                    ]));
                }
            } else {
                $model = new static([
                    'user_id' => $userID,
                    'ip' => $userIP
                ]);

                if (!$model->save()) {
                    throw new ErrorException('Could not save ' . UserIpLog::class . PHP_EOL . json_encode($model->errors));
                }

                if (floatval(Yii::$app->keyStorage->get('security.risk_score')) > 0) {
                    Yii::$app->queue->push(new RiskScoreJob([
                        'ipLogModelID' => $model->id
                    ]));
                }
            }
            return true;
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'ip_log');
        }

        return false;
    }
}
