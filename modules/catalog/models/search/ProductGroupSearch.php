<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\ProductGroup;

/**
 * ProductGroupSearch represents the model behind the search form about `app\modules\catalog\models\ProductGroup`.
 */
class ProductGroupSearch extends ProductGroup
{
    public $category;
    public $name_order;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'category'], 'integer'],
            [['name', 'image', 'description', 'name_order'], 'safe'],
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
        $query = ProductGroup::find();

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
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function searchCatalog($params)
    {
        $query = ProductGroup::find()->alias('p')->joinWith(['categories c'])->andWhere(['p.status' => 1])->groupBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 21
            ]
        ]);

        $this->load($params);

        $query->andFilterWhere(['like', 'p.name', $this->name]);

        if ($this->category > 0) {
            $query->andFilterWhere(['c.id' => $this->category]);
        }

        if ($this->name_order == 'name-desc') {
            $query->orderBy('p.name DESC');
        } else {
            $query->orderBy('p.name ASC');
        }

        return $dataProvider;
    }
}
