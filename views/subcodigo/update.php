<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subcodigos */

$this->title = 'Actualizar subcodigo: ' . ' ' . $model->codigo.'.'.$model->identificador.': '.$model->descripcionc;
$this->params['breadcrumbs'][] = ['label' => 'Subcodigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcodigos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
