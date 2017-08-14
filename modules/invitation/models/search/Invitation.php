<?php

namespace app\modules\invitation\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\invitation\models\Invitation as InvitationModel;

/**
 * Invitation represents the model behind the search form about `app\modules\invitation\models\Invitation`.
 */
class Invitation extends InvitationModel
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
            [['email', 'code', 'create_date', 'update_date', 'cr_date_from', 'cr_date_to'], 'safe'],
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
        $query = InvitationModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['create_date' => SORT_DESC]
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

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['>=', 'create_date', $this->cr_date_from ? strtotime($this->cr_date_from) : null])
            ->andFilterWhere(['<=', 'create_date', $this->cr_date_to ? strtotime($this->cr_date_to) : null]);

        return $dataProvider;
    }
}
