<?php

namespace app\modules\contact\models\search;

use app\helpers\DateHelper;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `app\modules\contact\models\Contact`.
 */
class ContactSearch extends Contact
{
    public $cr_date_from;
    public $cr_date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'email', 'subject', 'message'], 'safe'],
            [['cr_date_from', 'cr_date_to'], 'date', 'format' => 'mm/dd/yyyy']
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
        $query = Contact::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
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
            'status' => $this->status,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message]);

        if (!empty($this->cr_date_from)) {
            $query->andWhere('create_date >= :dateFrom', [':dateFrom' => date('Y-m-d H:i:s', strtotime($this->cr_date_from))]);
        }

        if (!empty($this->cr_date_to)) {
            $query->andWhere('create_date <= :dateTo', [':dateTo' => date('Y-m-d H:i:s', strtotime($this->cr_date_to))]);
        }

        return $dataProvider;
    }
}
