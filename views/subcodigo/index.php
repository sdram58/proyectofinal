<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubcodigosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcodigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcodigos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'identificador',
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:right;'],
            ],
            [
                'attribute' => 'codigo',
                'filter'=>$searchModel->getCodigos(),
                'content' => function ($data){
                    return $data->getCodigo0()->one()['descripcionc'];
                }
            ],
            //'descripcionv',
            'descripcionc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('+ Nuevo subcódigo', ['create'], ['class' => 'btn btn-primary']) ?>
        <br /><br />
        <?= Html::a('Ir a contabilidad', 'index.php?r=cuenta', ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>
    </p>

</div>
