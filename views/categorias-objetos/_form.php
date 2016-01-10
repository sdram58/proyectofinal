<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriasObjetos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-objetos-form categorias-form">
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5 error\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label','style'=>'text-align:center;min-width:100px;'],
        ],
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>
    <div class="error-envio-form error-form-label">Hay errores en el formulario que ha de subsanar!</div>
    <div class="form-group grupo-envio">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>        
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
<br />
 <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>