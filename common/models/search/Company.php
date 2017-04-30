<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company as CompanyModel;

/**
 * Company represents the model behind the search form of `common\models\Company`.
 */
class Company extends CompanyModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idType'], 'integer'],
            [['name', 'contact', 'phone', 'fax', 'email', 'bank', 'bankAccount', 'tariff', 'zone', 'address', 'zipcode', 'remark', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
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
        $query = CompanyModel::find();

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
            'idType' => $this->idType,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'deletedAt' => $this->deletedAt,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'bankAccount', $this->bankAccount])
            ->andFilterWhere(['like', 'tariff', $this->tariff])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
