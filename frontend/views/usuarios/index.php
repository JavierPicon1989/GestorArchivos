<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\select2\Select2; 
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
$model = new app\models\Usuarios;
?>
<div class="usuarios-index">

    <p>
        <?= Html::a(Yii::t('app', '+ Nuevo Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <?php

      $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],

        [
            'attribute' => 'username',
            'vAlign' => 'middle',
            'hAlign' => 'center'
        ],

        [
            'attribute' => 'email', 
            'vAlign' => 'middle',
            'hAlign' => 'center'         

        ],

        [
            'attribute' => 'status', 
            'value' => 'statusValue',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $model->getStatusArray(),
             'filterInputOptions' => [
                       'id' => 'status',
                    ],

            'filterWidgetOptions' => [
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => ['allowClear' => true,],
                'options' => ['placeholder' => Yii::t('app', 'Select...')
                ],
            ],
        ],

        [
            'class' => 'kartik\grid\ActionColumn', 
        ],

    ];

    ?>    
    <?= GridView::widget([

    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'pjax' => true,//recarga solo la vista y no toda la pagina
    'responsive'=>true,
    'hover'=>true,

    'toolbar'=>[
        '{export}',
        '{toggleData}'
    ],

    'panel' => [
        'heading'=>Yii::t('app', 'Users'),
        'type'=>'info', 
        'before'=> Html::a(Yii::t('app', 'Create user'), ['create'], 
                ['data-pjax' => 0, 'class' => 'btn btn-danger']),
        'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],

    ]);

     ?>


</div>
