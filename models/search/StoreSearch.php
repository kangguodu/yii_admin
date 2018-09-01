<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Store;
/**
 * StoreSearch represents the model behind the search form of `app\models\Store`.
 */
class StoreSearch extends Store
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'super_uid', 'type', 'avg_cost_low', 'avg_cost_high', 'routine_holiday', 'recommend_rank','status'], 'integer'],
            [['store_id', 'name', 'branchname', 'city', 'district', 'address', 'phone', 'email', 'company_name', 'company_tax_no', 'code', 'type_name', 'image', 'service_status', 'remark', 'avg_cost_status', 'facebook', 'instagram', 'google_keyword', 'coordinate', 'lat', 'lng', 'created_at', 'email_valid', 'special_holiday', 'special_business_day', 'is_return', 'search_keyword', 'description', 'service'], 'safe'],
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
        $query = Store::find();
        $query->select('`store`.*,store_account.credits_income,store_account.return_credits,store_account.business_income');
        $query->leftJoin('store_account','`store_account`.`store_id` = `store`.`id`');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'name',
                   'phone',
                   'type_name',
                   'created_at',
                   'credits_income',
                   'return_credits',
                   'status',
                   'business_income',
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
            'store.id' => $this->id,
            'store.type' => $this->type,
            'store.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'store.name', $this->name])
            ->andFilterWhere(['like', 'store.phone', $this->phone])
            ->andFilterWhere(['like', 'store.email', $this->email])
            ->andFilterWhere(['like', 'store.code', $this->code]);

        return $dataProvider;
    }

    
}
