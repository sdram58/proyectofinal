<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subcodigos;

/**
 * SubcodigosSearch represents the model behind the search form about `app\models\Subcodigos`.
 */
class SubcodigosSearch extends Subcodigos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'identificador', 'codigo'], 'integer'],
            [['descripcionv', 'descripcionc'], 'safe'],
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
        $query = Subcodigos::find();

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
            'identificador' => $this->identificador,
            'codigo' => $this->codigo,
        ]);

        $query->andFilterWhere(['like', 'descripcionv', $this->descripcionv])
            ->andFilterWhere(['like', 'descripcionc', $this->descripcionc]);

        return $dataProvider;
    }
}
