<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use kartik\daterange\DateRangePicker;

$this->title = Yii::t('app', 'Archivos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carpetas'), 'url' => ['/carpetas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivos-index">
<!--    <p>
        <php? Html::a(Yii::t('app', 'Crear Archivo Nuevo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php 
// echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,             
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'options' => ['style' => 'width: 4%;']],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'options' => ['style' => 'width: 5%;'],
                'template' => '{view} {update} {delete}',
                'buttons'=>[
		'view'=> 
                    function ($url, $model) {  
				$url=Url::toRoute(['/archivos/view',
                                    'id'=>$model->id]);
				return Html::a('<i class="fas fa-file"></i>', $url);                                
			},	
                ]
            ],            
                        
            'nombre',
            //'fechaInsert',
            [
                'attribute' => 'fecha',
                'value' => 'fecha',
                'options' => ['style' => 'width: 25%;'],
                'format' => 'date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'attribute' => 'fecha',
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'id' => 'fecha',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ])
            ],
            'unidad',
            'numeroMedidor',
            
            ['header'=>'Link de descarga',
            'format'=>'raw',
            'value' => function($data)
            {
            return
            Html::a('Descargar archivo', ['archivos/download', 'id' => $data->id],['class' => 'btn btn-info']);

            }
            ],

            ],
    ]); ?>
  


</div>
