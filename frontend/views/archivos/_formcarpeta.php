<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Carpetas;
use kartik\select2\Select2;

?>

<div class="archivos-form">

    <?php $form = ActiveForm::begin();
    date_default_timezone_set("America/Argentina/La_Rioja");
    $fecha = date('Y-m-d');
    $hora = date('H:m:s');
    $filterUser = Carpetas::find()->where(['id_usuario' => Yii::$app->user->identity->id])->all();?>
    
    <?= $form->field($model, 'id_carpeta')->hiddenInput(['value' => $id_carpeta])->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput (['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->hiddenInput(['readonly' => true, 'value' => 'ima/text.png'])->label(false) ?>   
    
    <?= Html::img($model->ruta, ['width'=> '60px'])?>
    
    <?= $form->field($model, 'archivo')->fileInput() ?>
    
    <?= $form->field($model, 'numeroMedidor')->textInput (['maxlength' => true])?>
    
    <?= $form->field($model, 'unidad')->textInput (['maxlength' => true])?>
    
    <?= $form->field($model, 'fecha')->hiddenInput(['value' => $fecha])->label('') ?>
    
    <?= $form->field($model, 'hora')->hiddenInput(['value' => $hora])->label('') ?>

    <?= $form->field($model, 'id_usuario')->hiddenInput(['value' => Yii::$app->user->identity->id])->label('') ?>

    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
