<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Codigos */

$this->title = 'Vista código '.$model->identificador;
$this->params['breadcrumbs'][] = ['label' => 'Codigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigos-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'identificador',
            'descripcionc',
            'descripcionv',
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
    </p>
    <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>

</div>
