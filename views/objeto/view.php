<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = isset($model->Descripcion)?strtoupper($model->tipo.": ".$model->Descripcion.' de '.$model->ubicacion):$model->id;
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
                'confirm' => '¿Estás seguro que quieres eliminar el objeto?',
                'method' => 'post',
            ],
        ]) ?>
        <!--Boton duplicar -->
        <a class='btn btn-warning btn-duplicar' title='Duplicar'>Duplicar</a>
        <?php include 'duplicar.php'; ?>
        <?php } ?>
        <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>
    </p>

</div>
