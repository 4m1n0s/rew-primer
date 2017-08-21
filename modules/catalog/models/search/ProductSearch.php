<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\catalog\models\Product`.
 */
class ProductSearch extends Product
{
    public $category;
    public $groupsFilter;

    public $price_from;
    public $price_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'category', 'type', 'vendor'], 'integer'],
            [['name', 'description', 'sku', 'groupsFilter'], 'safe'],
            [['price', 'price_from', 'price_to'], 'number'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->alias('p')->joinWith(['groups g'])->groupBy('p.id');

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
            'p.id' => $this->id,
            'p.status' => $this->status,
            'p.type' => $this->type,
            'p.vendor' => $this->vendor,
        ]);

        $query->andFilterWhere(['like', 'p.name', $this->name])
            ->andFilterWhere(['like', 'p.sku', $this->sku])
            ->andFilterWhere(['>=', 'p.price', $this->price_from])
            ->andFilterWhere(['<=', 'p.price', $this->price_to])
            ->andFilterWhere(['like', 'g.name', $this->groupsFilter])
            ->andFilterWhere(['like', 'p.description', $this->description]);

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
        $query = Product::find()->alias('p')->joinWith(['categories c'])->inStock()->groupBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 15
            ]
        ]);

        $this->load($params);

        $query->andFilterWhere(['like', 'p.name', $this->name]);

        if ($this->category > 0) {
            $query->andFilterWhere(['c.id' => $this->category]);
        }

        if ($this->price == 'price-desc') {
            $query->orderBy('p.price DESC');
        } else {
            $query->orderBy('p.price ASC');
        }

        return $dataProvider;
    }
}
