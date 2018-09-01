<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;

/**
 * MemberSearch represents the model behind the search form of `app\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'invite_count', 'number'], 'integer'],
            [['phone', 'username', 'nickname', 'email', 'gender', 'status', 'user_type'], 'safe'],
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
        $query = Member::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id'=>SORT_DESC],
                'attributes' => [
                   //Normal columns
                   'id',
                   'username',
                   'nickname',
                   'email',
                   'gender',
                   'user_type',
                   'status',
                   'phone',
                   'created_at'
              ],],
        ]);

        $dataProvider->pagination->defaultPageSize =20;

       // $dataProvider->setSort('id DESC');

       

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'user_type' => $this->user_type,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'email', $this->email]);
            // ->andFilterWhere(['like', 'zone', $this->zone])
            // ->andFilterWhere(['like', 'invite_code', $this->invite_code])
            // ->andFilterWhere(['like', 'promo_code', $this->promo_code])
            // ->andFilterWhere(['like', 'honor', $this->honor])

        return $dataProvider;
    }
}
