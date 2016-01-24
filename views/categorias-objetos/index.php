<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasObjetosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias Objetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-objetos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'id',
                
            ],
            [
                'attribute'=>'categoria',
                'content' => function($data){
                    return strtoupper($data->categoria);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('+ Nueva Categor&iacute;a', ['create'], ['class' => 'btn btn-primary']) ?>
        <br />
        <?= Html::a('Ir a inventario', 'index.php?r=objeto', ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
    </p>

</div>
