<?php

namespace app\modules\subscriber\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\subscriber\models\Subscribers;

/**
 * SubscriberSearch represents the model behind the search form about `app\modules\subscribe\models\Subscriber`.
 */
class SubscribersSearch extends Subscribers {
    
    public $dateFrom;
    public $dateTo;
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'frequency', 'status'], 'integer'],
            [['email', 'dateFrom', 'dateTo'], 'safe'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'dateFrom' => Yii::t('app', 'From'),
            'dateTo'   => Yii::t('app', 'To'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Subscribers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'frequency' => $this->frequency,
            'status' => $this->status,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email]);
        
        if (!empty($this->dateFrom)) {
            $query->andWhere('create_date >= :dateFrom', [':dateFrom' => $this->dateFrom]);
        }

        if (!empty($this->dateTo)) {
            $query->andWhere('create_date <= :dateTo', [':dateTo' => $this->dateTo]);
        }

        return $dataProvider;
    }

}
