<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivos */

$this->title = Yii::t('app', 'Agregar un arhivo nuevo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Archivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivos-create">


    <?= $this->render('_formcarpeta', [
        'model' => $model,
        'id_carpeta' => $id_carpeta,
    ]) ?>

</div>
