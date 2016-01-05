<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ubicaciones */

$this->title = $model->Descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Ubicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Descripcion',
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>
    </p>

</div>
