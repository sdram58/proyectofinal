<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoCategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategorías';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'tipo',
            [
                'attribute'=>'categoria',
                'content' => function($data){
                    return strtoupper($data->getMiCategoria()[$data->categoria]);
                },
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('+ Nueva Subcategoria', ['create'], ['class' => 'btn btn-primary']) ?>
        <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
    </p>

</div>
