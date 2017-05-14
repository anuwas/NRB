<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Featuregallery;

/**
 * FeaturegallerySearch represents the model behind the search form about `app\models\Featuregallery`.
 */
class FeaturegallerySearch extends Featuregallery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['featuregallery_id'], 'integer'],
            [['image', 'image_title', 'image_alt', 'created_date'], 'safe'],
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
        $query = Featuregallery::find();

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
            'featuregallery_id' => $this->featuregallery_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_title', $this->image_title])
            ->andFilterWhere(['like', 'image_alt', $this->image_alt]);

        return $dataProvider;
    }
}
