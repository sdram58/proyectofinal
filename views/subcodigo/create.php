<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subcodigos */

$this->title = 'Create Subcodigos';
$this->params['breadcrumbs'][] = ['label' => 'Subcodigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcodigos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
