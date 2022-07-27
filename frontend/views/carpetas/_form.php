<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carpetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carpetas-form">

    <?php $form = ActiveForm::begin(); 
    date_default_timezone_set("America/Argentina/La_Rioja");
    $fecha = date('Y-m-d');
    $hora = date('H:m:s');?>

    <?= $form->field($model, 'id_usuario')->hiddenInput(['readonly' => true, 'value' => Yii::$app->user->identity->id])->label(false) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaInsert')->hiddenInput(['readonly' => true, 'value' => $fecha])->label(false) ?>
    
    <?= $form->field($model, 'hora')->hiddenInput(['readonly' => true, 'value' => $hora])->label(false) ?>
    
    <?= $form->field($model, 'logo')->hiddenInput(['readonly' => true, 'value' => 'ima/folder.png'])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
