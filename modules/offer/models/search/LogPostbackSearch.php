<?php

namespace app\modules\offer\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\offer\models\LogPostback;

/**
 * LogPostbackSearch represents the model behind the search form about `app\modules\offer\models\LogPostback`.
 */
class LogPostbackSearch extends LogPostback
{
    public $offerFilter;
    public $log_time_from;
    public $log_time_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'offer_id'], 'integer'],
            [['category', 'prefix', 'message', 'log_vars', 'offerFilter', 'log_time_from', 'log_time_to'], 'safe'],
            [['log_time'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = LogPostback::find()->joinWith(['offer o']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['offerFilter'] = [
            'asc' => ['o.name' => SORT_ASC],
            'desc' => ['o.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'offer_id' => $this->offer_id,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'o.name', $this->offerFilter])
            ->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'log_vars', $this->log_vars])
            ->andFilterWhere(['>=', 'log_time', $this->log_time_from ? strtotime($this->log_time_from) : null])
            ->andFilterWhere(['<=', 'log_time', $this->log_time_to ? strtotime($this->log_time_to) : null]);

        return $dataProvider;
    }
}
