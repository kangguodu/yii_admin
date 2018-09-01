<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Withdraw;

/**
 * WithdrawSearch represents the model behind the search form of `app\models\Withdraw`.
 */
class WithdrawSearch extends Withdraw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id', 'uid'], 'integer'],
            [['type', 'status', 'remark', 'bank_name', 'receiver_name', 'bank_account', 'bank_phone', 'handle_note', 'handle_date', 'created_at'], 'safe'],
            [['amount', 'service_charge'], 'number'],
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
        $query = Withdraw::find();
        $query->select('`withdrawl`.*,store.name as `store_name`,`member`.`nickname`');
        $query->leftJoin('store','`store`.`id` = `withdrawl`.`store_id`');
        $query->leftJoin('member','`member`.`id` = `withdrawl`.`uid`');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                    //Normal columns
                    'id',
                    'type',
                    'amount',
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
            '`withdrawl`.id' => $this->id,
            '`withdrawl`.store_id' => $this->store_id,
            '`withdrawl`.uid' => $this->uid,
            '`withdrawl`.type' => $this->type,
            '`withdrawl`.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'bank_account', $this->bank_account])
            ->andFilterWhere(['like', 'bank_phone', $this->bank_phone])
            ->andFilterWhere(['like', 'handle_note', $this->handle_note]);

        return $dataProvider;
    }
}
