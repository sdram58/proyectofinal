<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objeto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); 
    //Solo usuarios logeados y con rol de inventario podrán modificar
    if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->inventario==1)) {
        $plantilla= '{view} {update} {delete}{link}';
        $anchoAction = ['width' => '70'];
        $accion='Acción';
    }else{
        $plantilla= '{view}{link}';
        $anchoAction = ['width' => '35'];
        $accion="Ver";
    }?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'showFooter'=>false,
        'showHeader' => true,
        'emptyCell'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [   
                'attribute' => 'estado',
                'filter'=>$estados,
                'format' => ['decimal', 2],
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:center;'],
                'content'=>function($data){
                     return $data::$estados[$data->estado];
                }

            ],
            'ubicacion',
            'categoria',
            'tipo',
            'Descripcion',
            [
                'attribute'=>'fecha_alta', 
                'contentOptions' =>['class' => 'table_class','style'=>'width:35px;text-align:center;'],
            ],
            [
                'attribute'=> 'fecha_baja',
                'contentOptions' =>['class' => 'table_class','style'=>'width:35px;text-align:center;'],
                'content'=>function($data){
                    $resultado = "";
                    if (isset($data->fecha_baja)){
                        $resultado = $data->fecha_baja;
                    }else{
                        $resultado = '<i>no definida</i>';                    
                    }
                     return $resultado;
                }
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> $accion,
                'headerOptions' => $anchoAction,
                'template' => $plantilla,
                ],
        ], 
        'options'=>['class'=>'grid-view gridview-newclass'],
        'tableOptions' =>['class' => 'table table-striped table-bordered'],
        'rowOptions'=>function ($model, $key, $index, $grid){
                $class=$index%2?'odd':'even';
                return array('key'=>$key,'index'=>$index,'class'=>$class);
            },

    ]); ?>
    
    <p>
        <?php if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->inventario==1)) { ?>
        <?= Html::a('A&ntilde;adir Elemento', ['create'], ['class' => 'btn btn-success']) ?>
       <?php }?>
        <?= Html::a('Imprimir', ['create'], ['class' => 'btn btn-success btn-imprimir']) ?>
    </p> 
        
    

</div>
