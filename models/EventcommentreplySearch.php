<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Eventcommentreply;

/**
 * EventcommentreplySearch represents the model behind the search form about `app\models\Eventcommentreply`.
 */
class EventcommentreplySearch extends Eventcommentreply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventcommentreplyid', 'eventcommentid', 'appuserid', 'eventid'], 'integer'],
            [['comment', 'created_date'], 'safe'],
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
        $query = Eventcommentreply::find();

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
            'eventcommentreplyid' => $this->eventcommentreplyid,
            'eventcommentid' => $this->eventcommentid,
            'appuserid' => $this->appuserid,
            'eventid' => $this->eventid,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
