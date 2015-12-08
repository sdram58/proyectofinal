<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ubicaciones */

$this->title = 'Create Ubicaciones';
$this->params['breadcrumbs'][] = ['label' => 'Ubicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
