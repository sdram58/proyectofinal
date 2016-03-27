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

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcionc',
            //'descripcionv',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('+ Nuevo Código', ['create'], ['class' => 'btn btn-primary']) ?>
        <br />
        <?= Html::a('Ir a contabilidad', 'index.php?r=cuenta', ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
        
    </p>

</div>
