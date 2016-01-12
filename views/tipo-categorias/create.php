<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoCategorias */

$this->title = 'Crear nueva Subcategoría';
$this->params['breadcrumbs'][] = ['label' => 'Crear Subcategoría', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'categorias'=>$categorias,
    ]) ?>

</div>
