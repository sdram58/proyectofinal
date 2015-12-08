<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoCategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SubCategorías';
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

            'id',
            'tipo',
            'categoria',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('Crear SubCategorias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
