<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Game;

class GameSearch extends Game
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'attempts'], 'integer'],
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
    
    public function search($params)
    {
        $query = Game::find();
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->filterWhere([
            'status' => $this->status,
            'attempts' => $this->attempts,
        ]);
        
        return $dataProvider;
    }
}

