<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label','style'=>'text-align:left;'],
        ],
    ]); ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inventario')->dropDownList($model::$permisos,['id'=>'tipo']) ?>

    <?= $form->field($model, 'contabilidad')->dropDownList($model::$permisos,['id'=>'tipo']) ?>
    
    <?= $form->field($model, 'usuario')->dropDownList($model::$permisos,['id'=>'tipo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
        <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
