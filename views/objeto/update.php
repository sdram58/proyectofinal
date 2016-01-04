<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = 'Actualizar el objeto: ' . ' ' . isset($model->Descripcion)?$model->Descripcion.' de '.$model->ubicacion:$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => isset($model->Descripcion)?$model->Descripcion.' de '.$model->ubicacion:$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="objeto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'categorias' => $categorias, 'ubicaciones'=>$ubicaciones,'estados' => $estados
    ]) ?>

</div>
