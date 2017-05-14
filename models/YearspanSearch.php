<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Yearspan;

/**
 * YearspanSearch represents the model behind the search form about `app\models\Yearspan`.
 */
class YearspanSearch extends Yearspan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yearspanid'], 'integer'],
            [['year_start', 'year_end', 'created_date'], 'safe'],
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
        $query = Yearspan::find();

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
            'yearspanid' => $this->yearspanid,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'year_start', $this->year_start])
            ->andFilterWhere(['like', 'year_end', $this->year_end]);

        return $dataProvider;
    }
}
