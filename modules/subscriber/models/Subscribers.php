<?php

namespace app\modules\subscriber\models;

use Yii;

/**
 * This is the model class for table "{{%subscribers}}".
 *
 * @property integer $id
 * @property string $email
 * @property integer $frequency
 * @property integer $status
 * @property string $create_date
 */
class Subscribers extends \yii\db\ActiveRecord {
    
    const STATUS_PAUSED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%subscribers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email'], 'required'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['frequency', 'status'], 'integer'],
            [['create_date'], 'safe'],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'            => Yii::t('app', 'ID'),
            'email'         => Yii::t('app', 'Email'),
            'frequency'     => Yii::t('app', 'Frequency'),
            'status'        => Yii::t('app', 'Status'),
            'create_date'   => Yii::t('app', 'Create Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return SubscriberQuery the active query used by this AR class.
     */
    public static function find() {
        return new SubscribersQuery(get_called_class());
    }
    
    public function getStatusList(){
        return [
            Subscriber::STATUS_PAUSED => Yii::t('app', 'Paused'),
            Subscriber::STATUS_ACTIVE => Yii::t('app', 'Active'),
        ];
    }
    
    public function getStatus($html = false){
        $data = $this->getStatusList();
        switch ($this->status){
            case self::STATUS_ACTIVE:
                $status = 'success';
                break;
            case self::STATUS_PAUSED:
                $status = 'warning';
                break;
        }
        
        if($html){
            if(isset($data[$this->status])){
                return "<span class=\"label label-sm label-$status\">{$data[$this->status]}</span>";
            }
            return "<span class=\"label label-sm label-$status\">" . Yii::t('app', 'Unknown') . "</span>";
        }
        
        return $data[$this->status];
    }
    
    public function activate(){
        return $this->updateAttributes([
            'status' => Subscriber::STATUS_ACTIVE,
        ]);
    }
    
    public function suspend(){
        return $this->updateAttributes([
            'status' => Subscriber::STATUS_PAUSED,
        ]);
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->create_date = \app\helpers\DateHelper::getCurrentDateTime();
        }
        return parent::beforeSave($insert);
    }

}
