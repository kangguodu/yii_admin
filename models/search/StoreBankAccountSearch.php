<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StoreBankAccount;

/**
 * StoreBankAccountSearch represents the model behind the search form of `app\models\StoreBankAccount`.
 */
class StoreBankAccountSearch extends StoreBankAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id'], 'integer'],
            [['bank_name', 'receiver_name', 'bank_account', 'bank_phone', 'branch_name', 'region', 'status', 'created_at'], 'safe'],
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
        $query = StoreBankAccount::find();
        $query->select('`store_bank_account`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`store_bank_account`.`store_id` = `store`.`id`');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'store_id',
                   'bank_name',
              ]
            ]
        ]);
        // add conditions that should always apply here


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '`store_bank_account`.id' => $this->id,
            '`store_bank_account`.store_id' => $this->store_id,
            '`store_bank_account`.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', '`store_bank_account`.bank_name', $this->bank_name])
            ->andFilterWhere(['like', '`store_bank_account`.receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', '`store_bank_account`.bank_account', $this->bank_account])
            ->andFilterWhere(['like', '`store_bank_account`.status', $this->status]);

        return $dataProvider;
    }
}
