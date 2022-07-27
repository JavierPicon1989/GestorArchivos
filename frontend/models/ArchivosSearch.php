<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Archivos;
use Yii;
use kartik\daterange\DateRangeBehavior;


/**
 * ArchivosSearch represents the model behind the search form of `app\models\Archivos`.
 */
class ArchivosSearch extends Archivos
{
    
// Método behavios importado de karkit
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_carpeta', 'id_usuario'], 'integer'],
            [['nombre', 'logo', 'fecha','hora', 'ruta', 'numeroMedidor','unidad'], 'safe'],
            //[['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
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

    public function search($params)
    {
        $query = Archivos::find();

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_carpeta' => $this->id_carpeta,
            'fecha' => $this->fecha,
            'id_usuario' => Yii::$app->user->identity->id,
            'numeroMedidor' => $this->numeroMedidor,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            
            ->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'numeroMedidor', $this->numeroMedidor]);
       //Convierte la cadena en un arreglo con las dos fechas
        
//         $query->andFilterWhere(['>=', 'createdAt', $this->createTimeStart])
//              ->andFilterWhere(['<', 'createdAt', $this->createTimeEnd]);
        return $dataProvider;
    }
   //////////////////////////////////////////////////////////////// 
    public function searchcarpeta($params, $id_carpeta)
    { 
        $query = Archivos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_carpeta' => $id_carpeta,
            'fecha' => $this->fecha,
            'id_usuario' => Yii::$app->user->identity->id,
            'numeroMedidor' => $this->numeroMedidor,
            
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
           
            ->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'numeroMedidor', $this->numeroMedidor]);

        return $dataProvider;
    }
    ////////////////////////////////////////////////////////////////
    
}
