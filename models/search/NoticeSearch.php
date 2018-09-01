<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notice;

/**
 * NoticeSearch represents the model behind the search form of `app\models\Notice`.
 */
class NoticeSearch extends Notice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'point_id', 'member_id'], 'integer'],
            [['title', 'description', 'type_id', 'content', 'icon', 'url', 'created_at', 'updated_at'], 'safe'],
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
        $query = Notice::find();

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
            'point_id' => $this->point_id
        ]);

        if(!empty($this->type_id)){
            $query->andFilterWhere(['type_id' => $this->type_id]);
        }else{
            $query->andFilterWhere(['in','type_id',[1,3]]);
        }


        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
