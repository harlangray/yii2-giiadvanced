<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Country;

/**
 * CountrySearch represents the model behind the search form about `app\models\Country`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cn_id', 'cn_continent_id', 'cn_area', 'cn_is_deleted', 'cn_deleted_by', 'cn_created_by'], 'integer'],
            [['cn_name', 'cn_deleted_at'], 'safe'],
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
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cn_id' => $this->cn_id,
            'cn_continent_id' => $this->cn_continent_id,
            'cn_area' => $this->cn_area,
            'cn_is_deleted' => $this->cn_is_deleted,
            'cn_deleted_at' => $this->cn_deleted_at,
            'cn_deleted_by' => $this->cn_deleted_by,
            'cn_created_by' => $this->cn_created_by,
        ]);

        $query->andFilterWhere(['like', 'cn_name', $this->cn_name]);

        return $dataProvider;
    }
}
