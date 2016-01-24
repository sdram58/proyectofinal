<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Codigos */

$this->title = 'Código nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Codigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
