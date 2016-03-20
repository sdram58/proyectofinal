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
        $plantilla= '{view} {update} {delete} {duply} {link}';
        $anchoAction = ['width' => '90'];
        $accion='Acción';
    }else{
        $plantilla= '{view}{link}';
        $anchoAction = ['width' => '35'];
        $accion="Ver";
    }?>
        <?= GridView::widget([
        'pager' => [
                'prevPageLabel'=>'Prev',
                'nextPageLabel'=>'Sig'
            ],
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
            [
                'attribute'=>'ubicacion',
                'content' => function($data){
                    return strtoupper($data->ubicacion);
                },
            ],
            /*[
                'attribute'=>'categoria',
                'content' => function($data){
                    return strtoupper($data->categoria);
                },
            ],*/
            [
                'attribute'=>'tipo',
                'content' => function($data){
                    return strtoupper($data->tipo);
                },
            ],
            [
                'attribute'=>'Descripcion',
                'content' => function($data){
                    return strtoupper($data->Descripcion);
                },
            ],
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
                'buttons' => [
                    'duply' => function ($url, $model, $key) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Duplicar'),
                            'aria-label' => Yii::t('yii', 'Duplicar'),
                            'data-pjax' => '0',
                        ]);
                        return Html::a('<span id="'.$model->id.'"class="glyphicon glyphicon-duplicate btn-duplicar"></span>', $url, $options);
                    },
                ]
                ],
        ], 
        'options'=>['class'=>'grid-view gridview-newclass'],
        'tableOptions' =>['class' => 'table table-striped table-bordered'],
        'rowOptions'=>function ($model, $key, $index, $grid){
                $class=$index%2?'odd':'even';
                return array('key'=>$key,'index'=>$index,'class'=>$class);
            },

    ]); ?>
    
    Elementos por página <input id="elexp" type="number" step="1"  name="inputexp" value="<?php echo $numxpag; ?>" min="1" max="100" style="width:50px;text-align: right"/>
    <a href="#" title="ir" class="btn btn-warning elporpag">ir</a>
    <br /><br />
    <p>
        <?php if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->inventario==1)) { ?>
        <?= Html::a('+ Nuevo Elemento', ['create'], ['class' => 'btn btn-success',"onclick"=>"ir()"]) ?>
       <?php }?>
        <?= Html::a('Listados', ['listado'], ['class' => 'btn btn-success btn-imprimir']) ?>
    </p>
    <?php include 'duplicar.php'; ?>
   
        
    

</div>
