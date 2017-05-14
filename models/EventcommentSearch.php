<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Eventcomment;

/**
 * EventcommentSearch represents the model behind the search form about `app\models\Eventcomment`.
 */
class EventcommentSearch extends Eventcomment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eventcommentid', 'appuserid', 'eventid'], 'integer'],
            [['comment', 'commentdate'], 'safe'],
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
        $query = Eventcomment::find();

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
            'eventcommentid' => $this->eventcommentid,
            'appuserid' => $this->appuserid,
            'eventid' => $this->eventid,
            'commentdate' => $this->commentdate,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
