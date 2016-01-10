<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objeto-form categorias-form">
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div><div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label','style'=>'text-align:center;min-width:100px;'],
        ],
    ]); ?>

    <?= $form->field($model, 'estado')->dropDownList($estados,['id'=>'tipo']) ?>

    <?= $form->field($model, 'ubicacion')->dropDownList($ubicaciones) ?>
    
    <?= $form->field($model, 'categoria')->dropDownList($categorias,['id' => 'input-categoria']) ?>
    
    <?php if($model->isNewRecord){ ?>
        <?= $form->field($model, 'tipo')->dropDownList($tiposCategorias,['id'=>'tipo-cat']) ?>
   <?php }else{ ?>
        <?= $form->field($model, 'tipo')->dropDownList([$model->tipo=>$model->tipo],['id'=>'tipo-cat']) ?>
   <?php } ?>   

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_alta')->textInput(['type' => 'date', 'id' => 'fecha_alta','placeholder'=>'aaaa-mm-dd', 'pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>
    
    <?= $form->field($model, 'fecha_baja')->textInput(['type' => 'date', 'id' => 'fecha_baja','placeholder'=>'aaaa-mm-dd','pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>

    <div class="form-group grupo-envio">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['id'=>'btn-crear-actualizar','class' => 'btn btn-primary']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
<br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
