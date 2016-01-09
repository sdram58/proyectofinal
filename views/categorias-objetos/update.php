<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriasObjetos */

$this->title = 'Actualizar Categorias Objetos: ' . ' ' . $model->categoria;
$this->params['breadcrumbs'][] = ['label' => 'Categorias Objetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->categoria, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="categorias-objetos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
