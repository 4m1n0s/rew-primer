<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\modules\catalog\models\Order`.
 */
class OrderSearch extends Order
{

    public $userName;
    public $date_from;
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'closed_user_id', 'closed_date', 'create_date', 'update_date'], 'integer'],
            ['cost', 'number'],
            [['note', 'userName'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d']
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
        $query = Order::find()->alias('o');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 100
            ]
        ]);

        $query->joinWith(['user']);

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'user_id' => [
                    'asc' => ['user_id' => SORT_ASC],
                    'desc' => ['user_id' => SORT_DESC],
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                ],
                'closed_date' => [
                    'asc' => ['closed_date' => SORT_ASC],
                    'desc' => ['closed_date' => SORT_DESC],
                ],
                'create_date' => [
                    'asc' => ['create_date' => SORT_ASC],
                    'desc' => ['create_date' => SORT_DESC],
                ],
                'cost' => [
                    'asc' => ['cost' => SORT_ASC],
                    'desc' => ['cost' => SORT_DESC],
                ],
                'userName' => [
                    'asc' => ['{{%users}}.username' => SORT_ASC],
                    'desc' => ['{{%users}}.username' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['create_date' => SORT_DESC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'cost' => $this->cost,
            'closed_user_id' => $this->closed_user_id,
            'closed_date' => $this->closed_date,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        $query
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['=', 'o.status', $this->status])
            ->andFilterWhere(['>=', 'o.create_date', $this->date_from ? strtotime($this->date_from) : null])
            ->andFilterWhere(['<=', 'o.create_date', $this->date_to ? strtotime($this->date_to) : null]);

        $query->joinWith(['user' => function ($q) {
            $q->where('{{%users}}.username LIKE "%' . $this->userName . '%"');
        }]);

        return $dataProvider;
    }
}
