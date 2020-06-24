<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CaseHistory;

/**
 * CaseHistorySearch represents the model behind the search form about `backend\models\CaseHistory`.
 */
class CaseHistorySearch extends CaseHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'case_id'], 'integer'],
            [['next_date', 'stage'], 'safe'],
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
        $query = CaseHistory::find();

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
            'next_date' => $this->next_date,
            'case_id' => $this->case_id,
        ]);

        $query->andFilterWhere(['like', 'stage', $this->stage]);

        return $dataProvider;
    }
}
