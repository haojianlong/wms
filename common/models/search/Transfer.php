<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transfer as TransferModel;

/**
 * Transfer represents the model behind the search form of `common\models\Transfer`.
 */
class Transfer extends TransferModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idArOut', 'idArInto', 'quantity'], 'integer'],
            [['note', 'createdAt', 'updatedAt', 'deleteAt'], 'safe'],
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
        $query = TransferModel::find();

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
            'idArOut' => $this->idArOut,
            'idArInto' => $this->idArInto,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'deleteAt' => $this->deleteAt,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
