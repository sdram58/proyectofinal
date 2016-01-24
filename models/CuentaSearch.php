<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cuenta;

/**
 * CuentaSearch represents the model behind the search form about `app\models\Cuenta`.
 */
class CuentaSearch extends Cuenta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipocuenta', 'idconcepto','gastoingreso'], 'integer'],
            [['saldo','saldoactual'], 'number'],
            [['fecha', 'descripcion'], 'safe'],
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
        $query = Cuenta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         /*$dataProvider->sort->attributes['id'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['id' => SORT_ASC],
        'desc' => ['id' => SORT_DESC],
        ];*/
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tipocuenta' => $this->tipocuenta,
            'saldo' => $this->saldo,
            'idconcepto' => $this->idconcepto,
            'fecha' => $this->fecha,
            'gastoingreso' => $this->gastoingreso,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
