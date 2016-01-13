<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); 
    //Solo usuarios logeados y con rol de inventario podrán modificar
    if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->contabilidad==1)) {
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [   
                'attribute' => 'tipocuenta',
                'filter'=>$searchModel::$cuentas,
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:center;'],
                'content'=>function($data){
                     return $data::$cuentas[$data->tipocuenta];
                }

            ],
            'saldo',
            'idconcepto',
            'fecha',
            'descripcion',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> $accion,
                'headerOptions' => $anchoAction,
                'template' => $plantilla,
                ],       
                    
              
        ],
    ]); ?>
    
     <p>
        <?php if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->contabilidad==1)) { ?>
        <?= Html::a('+ Nuevo cuenta', ['create'], ['class' => 'btn btn-success']) ?>
       <?php }?>
        <?= Html::a('Listados', ['listado'], ['class' => 'btn btn-success btn-imprimir']) ?>
        <br /><br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:50%;']) ?>
    </p>

</div>
