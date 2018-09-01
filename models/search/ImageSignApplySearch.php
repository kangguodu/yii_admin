<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ImageSignApply;

/**
 * ImageSignApplySearch represents the model behind the search form of `app\models\ImageSignApply`.
 */
class ImageSignApplySearch extends ImageSignApply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id'], 'integer'],
            [['other_remark', 'created_at', 'updated_at', 'status', 'cancel_reason', 'address'], 'safe'],
            [['imagesign_carriage'], 'number'],
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
        $query = ImageSignApply::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'store_id',
                   'status',
                   'created_at'
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
            'store_id' => $this->store_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'imagesign_carriage' => $this->imagesign_carriage,
        ]);

        $query->andFilterWhere(['like', 'other_remark', $this->other_remark])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cancel_reason', $this->cancel_reason])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
