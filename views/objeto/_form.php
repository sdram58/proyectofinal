<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objeto-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado')->dropDownList($estados,['id'=>'tipo']) ?>

    <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones) ?>
    
    <?= $form->field($model, 'categoria')->dropDownList($categorias,['onchange' => 'cambiarTipo(this,"tipo-cat")']) ?>
    
    <?php if($model->isNewRecord){ ?>
        <?= $form->field($model, 'tipo')->dropDownList($tiposCategorias,['id'=>'tipo-cat']) ?>
   <?php }else{ ?>
        <?= $form->field($model, 'tipo')->dropDownList([$model->tipo=>$model->tipo],['id'=>'tipo-cat']) ?>
   <?php } ?>   

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_alta')->textInput(['type' => 'date', 'id' => 'fecha_alta','placeholder'=>'aaaa-mm-dd','required' => true, 'pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>
    
    <?= $form->field($model, 'fecha_baja')->textInput(['type' => 'date', 'id' => 'fecha_baja','placeholder'=>'aaaa-mm-dd','pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['id'=>'btn-crear-actualizar','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
