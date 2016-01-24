<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = isset($model->Descripcion)?$model->Descripcion.' de '.$model->ubicacion:$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objeto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
            'label' => 'estado',
            'value' => $model::$estados[$model->estado],
            ],
            'ubicacion',
            [
                'label'=>'categoria',
                'value' => $model->getCategoria0()->all()[0]['categoria'],
            ],
            'tipo',
            'Descripcion',
            'fecha_alta',
            'fecha_baja',
        ],
    ]) ?>
    <p>        
        <?php if(!$noPermiso){ ?>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
        <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>
    </p>

</div>
