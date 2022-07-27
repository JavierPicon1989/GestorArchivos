<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carpetas;
use yii;
/**
 * CarpetasSearch represents the model behind the search form of `app\models\Carpetas`.
 */
class CarpetasSearch extends Carpetas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'id_subcarpeta'], 'integer'],
            [['nombre', 'fechaInsert', 'hora', 'logo'], 'safe'],
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
        $query = Carpetas::find()->orderBy('nombre');;//->where('id_usuario' == Yii::$app->user->identity->id);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            
            'query' => $query,
            'pagination' => ['pageSize' => 5]
            
            
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
            'id_usuario' => Yii::$app->user->identity->id,
            'fechaInsert' => $this->fechaInsert,
            'id_subcarpeta' =>  0,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
        
        //$query->andFilterWhere(['like','logo', $this->logo]);

        return $dataProvider;
    }
    
    
    
    
    
    //////////////////////////////////////////////////////////
    public function searchsub($params)
    {
        $query = Carpetas::find()->orderBy('nombre');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
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
            'id_usuario' => Yii::$app->user->identity->id,
            'fechaInsert' => $this->fechaInsert,
        ]);
        $query->andFilterWhere(['not like', 'id_subcarpeta', 0]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
    public function searchsubcarpeta($params, $id_sub)
    {
        $query = Carpetas::find()->orderBy('nombre');
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
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
            'id_usuario' => Yii::$app->user->identity->id,
            'fechaInsert' => $this->fechaInsert,
        ]);
        $query->andFilterWhere(['like', 'id_subcarpeta', $id_sub]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
