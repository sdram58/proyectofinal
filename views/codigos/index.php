<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CodigosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Codigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Codigos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'identificador',
            'descripcionc',
            'descripcionv',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
