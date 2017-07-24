<?php

namespace app\modules\core\models\search;

use app\modules\core\models\Transaction;
use app\modules\offer\models\Offer;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\IdentityInterface;

class TransactionSearch extends Transaction
{
    public $date_from;
    public $date_to;

    public $offer_wall;
    public $name_campaign;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
            [['offer_wall', 'name_campaign'], 'safe']
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
        $query = TransactionSearch::find()->user($user)->type(Transaction::TYPE_OFFER_INCOME);
        $query
            ->select('`local_transaction`.*, COALESCE(`local_ref_transaction_offer`.`campaign_name`, `local_offer`.`name`) as `name_campaign`')
            ->joinWith(['offer']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'name_campaign' => [
                    'asc' => ['name_campaign' => SORT_ASC],
                    'desc' => ['name_campaign' => SORT_DESC],
                ],
                'offer_wall' => [
                    'asc' => [Offer::tableName().'.name' => SORT_ASC],
                    'desc' => [Offer::tableName().'.name' => SORT_DESC],
                ],
                'amount' => [
                    'asc' => ['amount' => SORT_ASC],
                    'desc' => ['amount' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['created_at' => SORT_DESC]
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
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to) : null])
            ->andFilterWhere(['like', 'name', $this->offer_wall])
            ->filterHaving(['like', 'name_campaign', $this->name_campaign]);

        return $dataProvider;
    }
}