<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contactus;

/**
 * ContactusSearch represents the model behind the search form about `app\models\Contactus`.
 */
class ContactusSearch extends Contactus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contactusid'], 'integer'],
            [['fullname', 'emailid', 'phone_number', 'contat_message', 'created_date'], 'safe'],
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
        $query = Contactus::find();

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
            'contactusid' => $this->contactusid,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'emailid', $this->emailid])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'contat_message', $this->contat_message]);

        return $dataProvider;
    }
}
