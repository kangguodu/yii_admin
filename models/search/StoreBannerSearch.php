<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StoreBanner;

/**
 * StoreBannerSearch represents the model behind the search form of `app\models\StoreBanner`.
 */
class StoreBannerSearch extends StoreBanner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'store_id', 'rank'], 'integer'],
            [['image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = StoreBanner::find();
        $query->select('`store_banner`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`store_banner`.`store_id` = `store`.`id`');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_ASC,'store_id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'store_id',
                   'rank',
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
            '`store_banner`.id' => $this->id,
            '`store_banner`.store_id' => $this->store_id
        ]);

        return $dataProvider;
    }
}
