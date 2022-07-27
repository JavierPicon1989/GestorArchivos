<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?=  $form->field($model, 'status')->widget(Select2::classname(), [

	    'data' => $model->getStatusArray(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'size' => Select2::LARGE,
	    'options' => ['placeholder' => Yii::t('app', 'Select...')],

	    'pluginOptions' => [
	        'allowClear' => true
	    ],

		]);

     ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
