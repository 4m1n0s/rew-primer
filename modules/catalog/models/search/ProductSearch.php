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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'category'], 'integer'],
            [['name', 'sku', 'description'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

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
            'price' => $this->price,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sku', $this->sku])
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
