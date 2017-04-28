<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AR as ARModel;

/**
 * AR represents the model behind the search form of `common\models\AR`.
 */
class AR extends ARModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idUser', 'idCompany', 'idProduct', 'idWarehouse', 'type'], 'integer'],
            [['date', 'note', 'createdAt', 'updatedAt', 'deleteAt'], 'safe'],
            [['quantity', 'price'], 'number'],
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
        $query = ARModel::find();

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
            'idUser' => $this->idUser,
            'idCompany' => $this->idCompany,
            'idProduct' => $this->idProduct,
            'idWarehouse' => $this->idWarehouse,
            'date' => $this->date,
            'type' => $this->type,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'deleteAt' => $this->deleteAt,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
