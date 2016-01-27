<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subcodigos */

$this->title = 'Vista subcódigo '.$model->codigo.'.'.$model->identificador;
$this->params['breadcrumbs'][] = ['label' => 'Subcodigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo '<script>alert('.$model->getCodigo0()->one()['descripcionv'].')</script>';
?>
<div class="subcodigos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'identificador',
            [
                'label' => 'Código',
                  'value' => $model->getCodigo0()->one()['descripcionc'],
            ],
            //'descripcionv',
            'descripcionc',
        ],
    ]) ?>
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro que quieres borrar el subcódigo?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>

</div>
