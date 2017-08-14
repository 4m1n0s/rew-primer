<?php

namespace app\modules\core\models\search;

use app\modules\core\models\RefTransactionReferral;
use app\modules\core\models\Transaction;
use app\modules\offer\models\Offer;
use app\modules\user\models\Referral;
use app\modules\user\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\IdentityInterface;

class TransactionSearch extends Transaction
{
    public $date_from;
    public $date_to;

    public $total_amount;
    public $total_amount_from;
    public $total_amount_to;
    public $amount_from;
    public $amount_to;

    public $offer_wall;
    public $name_campaign;

    public $referral_username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'amount_from', 'amount_to', 'total_amount', 'total_amount_from', 'total_amount_to'], 'number'],
            [['date_from', 'date_to', 'offer_wall', 'name_campaign', 'referral_username'], 'safe']
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
            ->select('{{%transaction}}.*, COALESCE({{%ref_transaction_offer}}.`campaign_name`, {{%offer}}.`name`) as `name_campaign`')
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
            ->andFilterWhere(['>=', 'amount', $this->amount_from])
            ->andFilterWhere(['<=', 'amount', $this->amount_to])
            ->andFilterWhere(['like', 'name', $this->offer_wall])
            ->filterHaving(['like', 'name_campaign', $this->name_campaign]);

        return $dataProvider;
    }

    public function searchReferrals($params, IdentityInterface $user)
    {
        $query = (new Query())
            ->select(['s.id', 's.username', 's.email', 'sum(t.amount) as total_amount'])
            ->from(['s' => User::tableName()])
            ->innerJoin(['referral' => Referral::tableName()], 's.id = referral.target_user_id')
            ->innerJoin(['r' => User::tableName()], 'r.id = referral.source_user_id')
            ->leftJoin(['tr' => RefTransactionReferral::tableName()], 'tr.user_id = s.id')
            ->leftJoin(['t' => Transaction::tableName()], 'tr.transaction_id = t.id')
            ->where(['r.id' => $user->getId()])
            ->groupBy('s.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'referral_username' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                ],
                'total_amount' => [
                    'asc' => ['total_amount' => SORT_ASC],
                    'desc' => ['total_amount' => SORT_DESC],
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            's.id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 's.username', $this->referral_username])
            ->andFilterHaving(['>=', 'total_amount', $this->total_amount_from])
            ->andFilterHaving(['<=', 'total_amount', $this->total_amount_to]);

        return $dataProvider;
    }
}