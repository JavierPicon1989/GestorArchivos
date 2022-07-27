<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\growl\Growl;


$this->title = Yii::t('app', 'Carpeta: '.$nombre);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carpetas'), 'url' => ['/carpetas']];
$this->params['breadcrumbs'][] = $this->title;
$idSc = $idF;


?>
<div class="archivos-index">
    <p>
        <?= Html::a(Yii::t('app', '+ Nueva Carpeta'), 
                ['carpetas/create_sc','idSc'=>$idSc], ['class' => 'btn btn-info']) ?>

        <?= Html::a(Yii::t('app', '+ Nuevo Archivo'), ['create', 
            'id_carpeta' => $idF], 
                ['class' => 'btn btn-success']) ?>
        
    </p>
<h3>Sub carpetas</h3>
  

<?= GridView::widget([
    'dataProvider' => $dataProviderS,
    'filterModel' => $searchModelS, 
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
         'options' => ['style' => 'width: 4%;']],
        [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'options' => ['style' => 'width: 5%;'],
                'template' => '{folder} {delete} {update}',
                'buttons'=>[
		'folder'=> 
                    function ($url, $model) {  
				$url=Url::toRoute(['/archivos/folder',
                                    'id'=>$model->id,
                                    'nombre'=>$model->nombre,
                                    'id_subcarpeta' => $model->id_subcarpeta]);
				return Html::a('<i class="fas fa-folder-open"></i>', $url);                                
			},
                'delete' => function($url, $searchModelS){
                return Html::a('<i class="fas fa-trash-alt"></i>', ['carpetas/delete', 'id' => $searchModelS->id], [
                'class' => '',
                'data' => [
                    'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                    'method' => 'post',
                ],
            ]);
        }                              
			
                
                ]
        ],
        'nombre',
        [
                'attribute' => 'fechaInsert',
                'value' => 'fechaInsert',
                'options' => ['style' => 'width: 15%;'],
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
        
            
    ],
    ]); ?>   
<h3>Archivos</h3>
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
        'numeroMedidor',
        'unidad',
        [
                'attribute' => 'fecha',
                'value' => 'fecha',
                'options' => ['style' => 'width: 15%;'],
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


<?php
    if(yii::$app->session->getFlash("success")){  
            echo Growl::widget([
            'type' => Growl::TYPE_WARNING,
            'title' => 'Carpeta creada con exito!',
            'icon' => 'fas fa-check-circle',
            'body' => yii::$app->session->getFlash("success"),
            'showSeparator' => true,
            'delay' => 1000,
            'pluginOptions' => [
                'showProgressbar' => false,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
             'timer' => 1500,
            ]
            ]);
    }elseif(yii::$app->session->getFlash("error")){
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'Ha ocurrido un error al crear la carpeta!',
                'icon' => 'fas fa-times-circle',
                'body' => yii::$app->session->getFlash("success"),
                'showSeparator' => true,
                'delay' => 1000,
                'pluginOptions' => [
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ],
                'timer' => 1500,                    
                ]
                ]);
    }
    ?>




</div>
