<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCategorias */

$this->title = 'Actualizar Subcategoría: ' . ' ' . $model->tipo;
$this->params['breadcrumbs'][] = ['label' => 'Actualizar Subcategoría', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,'categorias'=>$categorias,
    ]) ?>

</div>
