<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objeto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= /*$form->field($model, 'id')->textInput() ?>

    <?= */$form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true])->label("Ubicaci&oacute;n") ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true])->label('Categor&iacute;a') ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true])->label("Descripci&oacute;n") ?>

    <?= $form->field($model, 'fecha_alta')->textInput(['type' => 'date']) ?>
    <script>
        
    </script>

    <?= $form->field($model, 'fecha_baja')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
