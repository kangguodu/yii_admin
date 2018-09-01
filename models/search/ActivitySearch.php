<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'content', 'description', 'type', 'created_at', 'created_by', 'start_at', 'expire_at', 'checked', 'platform_type', 'posters_pictures', 'discount', 'url', 'show_time'], 'safe'],
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
        $query = Activity::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => [
                'defaultOrder' => ['expire_at'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'start_at',
                   'expire_at',
                   'status'
              ]
            ]
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
            'created_at' => $this->created_at,
            'start_at' => $this->start_at,
            'expire_at' => $this->expire_at,
            'show_time' => $this->show_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'checked', $this->checked])
            ->andFilterWhere(['like', 'platform_type', $this->platform_type])
            ->andFilterWhere(['like', 'posters_pictures', $this->posters_pictures])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
