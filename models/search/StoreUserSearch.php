<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StoreUser;

/**
 * StoreUserSearch represents the model behind the search form of `app\models\StoreUser`.
 */
class StoreUserSearch extends StoreUser
{

    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id'], 'integer'],
            [['nickname', 'email', 'mobile', 'zone', 'password', 'permission', 'email_status', 'token', 'gender', 'super_account', 'position', 'menus'], 'safe'],
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
        $query = StoreUser::find();
        $query->select('`store_user`.*,`store`.`name` as `store_name`');
        $query->leftJoin('store','`store_user`.`store_id` = `store`.`id`');
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
            '`store_user`.id' => $this->id,
            '`store_user`.store_id' => $this->store_id,
        ]);

        $query->andFilterWhere(['like', '`store_user`.nickname', $this->nickname])
            ->andFilterWhere(['like', '`store_user`.mobile', $this->mobile])
            ->andFilterWhere(['like', '`store_user`.super_account', $this->super_account]);

        return $dataProvider;
    }
}
