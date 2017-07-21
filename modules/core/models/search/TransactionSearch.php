<?php

namespace app\modules\core\models\search;

use app\modules\core\models\Transaction;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\IdentityInterface;

class TransactionSearch extends Transaction
{
    public $date_from;
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
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
     * @param IdentityInterface $user
     *
     * @return ActiveDataProvider
     */
    public function searchCompletion($params, IdentityInterface $user)
    {
        $query = Transaction::find()->user($user)->type(Transaction::TYPE_OFFER_INCOME);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'amount' => $this->amount,
        ]);

        $query
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from) : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to) : null]);

        return $dataProvider;
    }
}