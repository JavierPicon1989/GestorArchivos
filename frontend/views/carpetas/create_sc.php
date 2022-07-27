<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carpetas */

$this->title = Yii::t('app','Nueva Carpeta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nueva Carpeta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carpetas-create">

    

    <?= $this->render('_form_sc', [
        'model' => $model,
        'idSc' => $idSc,
    ]) ?>

</div>
