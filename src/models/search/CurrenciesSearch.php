<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Currencies;

/**
 * app\models\search\CurrenciesSearch represents the model behind the search form about `app\models\Currencies`.
 */
 class CurrenciesSearch extends Currencies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'decimal_places', 'status', 'created_by', 'updated_by', 'deleted'], 'integer'],
            [['currency_name', 'currency_code', 'currency_symbol', 'created_at', 'updated_at'], 'safe'],
            [['exchange_rate'], 'number'],
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
        $query = Currencies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'exchange_rate' => $this->exchange_rate,
            'decimal_places' => $this->decimal_places,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'currency_name', $this->currency_name])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'currency_symbol', $this->currency_symbol]);

        return $dataProvider;
    }
}
