<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cuenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuenta-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div><div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label','style'=>'text-align:right;min-width:100px;'],
        ],
    ]); ?>

    <?= $form->field($model, 'tipocuenta')->dropDownList($model::$cuentas) ?>
    
    <?= $form->field($model, 'gastoingreso')->dropDownList($model::$GASTO_INGRESO) ?>

    <?= $form->field($model, 'saldo')->textInput() ?>

    <?= $form->field($model, 'idconcepto')->dropDownList($model->getConceptos()) ?>
    
    <?php if($model->isNewRecord){ 
        $fechaHoy = date('Y-m-d',time());
        ?>
        <?= $form->field($model, 'fecha')->textInput(['type' => 'date','value'=>$fechaHoy, 'id' => 'fecha','placeholder'=>'aaaa-mm-dd', 'pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>
   <?php }else{ ?>
        <?= $form->field($model, 'fecha')->textInput(['type' => 'date', 'id' => 'fecha','placeholder'=>'aaaa-mm-dd', 'pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>
   <?php } ?> 
    
    

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <div class="form-group grupo-envio">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
