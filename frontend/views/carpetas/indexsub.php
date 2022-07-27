<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\growl\Growl;
use kartik\widgets\DatePicker;
use yii\bootstrap4\Modal;


$this->title = Yii::t('app', 'Carpetas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carpetas-index">

    <p>
        <?php
        //Html::button('+ Nueva Carpeta', ['value'=> Url::to('carpetas/create_modal'), 
          //  'class' => 'btn btn-success','id'=>'modalButton']) ?>
        <?= Html::a(Yii::t('app', '+ Nueva Carpeta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        Modal::begin([
            'title'=>'+ Nueva Carpeta',
            'id'=>'modal',
            'size'=>'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        
        Modal::end();
    
    ?>
    
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,             
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'options' => ['style' => 'width: 4%;']],            
            [
            'options' => ['style' => 'width: 3%;'],
            'format'=>'html',
            'value' =>function ($data){ return Html::img($data->logo, ['width'=> '30px']); },
            ],
            
            'nombre',
            //'fechaInsert',
            [
                'attribute' => 'fechaInsert',
                'value' => 'fechaInsert',
                'options' => ['style' => 'width: 25%;'],
                'format' => 'date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'attribute' => 'fechaInsert',
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'id' => 'fechaInsert',
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ])
            ],
            //'hora',
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
	
                ]
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
