<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\Roles;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',          
            [   
                'attribute' => 'inventario',
                'filter'=>$searchModel::$permisos,
                'contentOptions' =>['class' => 'table_class',],
                'content'=>function($data){
                     return $data::$permisos[$data->inventario];
                }

            ],
                    
            [   
                'attribute' => 'contabilidad',
                'filter'=>$searchModel::$permisos,
                'contentOptions' =>['class' => 'table_class',],
                'content'=>function($data){
                     return $data::$permisos[$data->contabilidad];
                }

            ],
                    
            [   
                'attribute' => 'usuario',
                'filter'=>$searchModel::$permisos,
                'contentOptions' =>['class' => 'table_class',],
                'content'=>function($data){
                     return $data::$permisos[$data->usuario];
                }

            ],
                    
            [              
                'class' => 'yii\grid\ActionColumn',
                'header'=> 'Acci&oacute;n',
            ],
        ],
    ]); ?>
    
    <p>
        <?= Html::a('+ Nuevo usuario', ['create'], ['class' => 'btn btn-primary']) ?>
        <br />
        <?= Html::a('Volver', 'index.php', ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
    </p>

</div>
