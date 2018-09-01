<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'store_id', 'member_id', 'amount', 'coupons_id', 'status', 'checkout_user_id', 'refund_user_id', 'updated_by', 'number', 'is_evaluate'], 'integer'],
            [['order_no', 'order_sn', 'month', 'date', 'store_name', 'checkout_at', 'refund_at', 'created_at', 'updated_at'], 'safe'],
            [['credits', 'coupons_money', 'prate', 'mfixedrate', 'mrate', 'promoreate'], 'number'],
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
        $query = Orders::find();

        $query->select('`orders`.*,`member`.`nickname` as `nickname`,`member`.`username` as `username`');
        $query->leftJoin('member','`orders`.`member_id` = `member`.`id`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'member_id',
                   'order_no',
                   'amount',
                   'store_name',
                   'nickname',
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
            '`orders`.id' => $this->id,
            '`orders`.date' => $this->date,
            '`orders`.store_id' => $this->store_id,
            '`orders`.member_id' => $this->member_id,
            '`orders`.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', '`orders`.order_no', $this->order_no]);

        return $dataProvider;
    }
}
