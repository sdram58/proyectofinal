<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cuenta */

$this->title = "Movimiento:".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
   <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['label'=>'Cuenta',
              'value'=>$model::$cuentas[$model->tipocuenta],
                ],
            'saldo',
            [
                'label'=>'Concepto',
                'value'=>$model->getConceptoById($model->idconcepto),
            ],
            'fecha',
            'descripcion',
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro que quieres borrar la cuenta?',
                'method' => 'post',
            ],
        ]) ?>
        <br />
        <br /><br />
        <?= Html::a('Crear otra', ['create'], ['class' => 'btn btn-success','style'=>'margin-left:38%;']) ?> &nbsp;
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:5%;']) ?>
    </p>

</div>
