<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="cuenta-form">
        <?php $form = ActiveForm::begin([
            'options' => ['id'=>'form-cuenta'],
            'fieldConfig' => [
            'template' => "{label}\n{input}\n<div class=\"mierror\">{error}</div>",
            'labelOptions' => ['class' => 'control-label','style'=>'text-align:left;min-width:100px;'],
        ],
        ]); ?>
        <div class="row">
            <div class="col-xs-1">
              <?= $form->field($model, 'tipocuenta')->dropDownList($model::$cuentas) ?>
            </div>
             <div class="col-xs-2">
              <?= $form->field($model, 'gastoingreso')->dropDownList($model::$GASTO_INGRESO,["id"=>'tipocuenta']) ?>
            </div>
            <div class="col-xs-1">
              <?= $form->field($model, 'saldo')->textInput() ?>
            </div>
            <div class="col-xs-2">
               <?= $form->field($model, 'idconcepto')->dropDownList($model->getConceptosGastos(),["id"=>'gastosingresos']) ?>
            </div>
            <div class="col-xs-2">
              <?php $fechaHoy = date('Y-m-d',time()); ?>
        <?= $form->field($model, 'fecha')->textInput(['type' => 'date','value'=>$fechaHoy, 'id' => 'fecha','placeholder'=>'aaaa-mm-dd', 'pattern' => '^(\d{4})(-)([0][1-9]|[1][0-2])(-)([0][1-9]|[12][0-9]|3[01])$', ]) ?>
            </div>
            <div class="col-xs-3">
              <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                
            </div>
            <div class="col-xs-1">
                <div class="form-group">
                   <a id='btnenviar' title='Nuevo'><span class="glyphicon glyphicon-plus nuevo"></span></a>
               </div> 
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="wrapcuentas">
    <div class="row cuentas">
        <div class="col-xs-4 cuenta">
            <p>Ingresos cuenta A: <span><?php echo number_format($saldoIngresosA,2,'.',','); ?>€</span></p>
            <p>Ingresos cuenta B: <span><?php echo number_format($saldoIngresosB,2,'.',','); ?>€</span></p>
            <p>Total Ingresos: <span><?php echo number_format($saldoIngresosA+$saldoIngresosB,2,'.',','); ?>€</span></p>
        </div>
        <div class="col-xs-4 cuenta">
            <p>Gastos cuenta A: <span><?php echo number_format($saldoGastosA,2,'.',','); ?>€</span></p>
            <p>Gastos cuenta B: <span><?php echo number_format($saldoGastosB,2,'.',','); ?>€</span></p>
            <p>Total Gastos: <span><?php echo number_format($saldoGastosA+$saldoGastosB,2,'.',','); ?>€</span></p>
        </div>
        <div class="col-xs-4 cuenta">
            <p>Saldo cuenta A: <span><?php echo number_format($saldoA,2,'.',','); ?>€</span></p>
            <p>Saldo cuenta B: <span><?php echo number_format($saldoB,2,'.',','); ?>€</p>
            <p>Total: <span><?php echo number_format($saldoA+$saldoB,2,'.',','); ?>€</p>
        </div>
                
    </div>

    
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

            [   
                'attribute' => 'id',                
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:right;'],
                ],
            [   
                'attribute' => 'tipocuenta',
                'filter'=>$searchModel::$cuentas,
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:center;'],
                'content'=>function($data){
                     return $data::$cuentas[$data->tipocuenta];
                }

            ],
            [   
                'attribute' => 'gastoingreso',
                'filter'=>$searchModel::$GASTO_INGRESO,
                'contentOptions' =>['class' => 'table_class','style'=>'width:30px;text-align:center;'],
                'content'=>function($data){
                     return $data::$GASTO_INGRESO[$data->gastoingreso];
                }

            ],
                    
             [   
                'attribute' => 'saldo',
                //'filter'=>$searchModel->getConceptos(),
                'contentOptions' =>['class' => 'table_class','style'=>'width:80px;text-align:right;'],
                'content'=>function($data){
                     return number_format($data->saldo,2,'.',',');
                }

            ],       
            [   
                'attribute' => 'idconcepto',
                'filter'=>$searchModel->getConceptos(),                
                'content'=>function($data){
                     return $data->getConceptos()[$data->idconcepto];
                }

            ],            
            [   
                'attribute' => 'fecha',
                'contentOptions' =>['class' => 'table_class','style'=>'width:100px;text-align:right;'],
            ],
            'descripcion',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> $accion,
                'headerOptions' => $anchoAction,
                'template' => $plantilla,
                ],       
                    
              
        ],
    ]); ?>
    
    Elementos por página <input id="elexp" type="number" step="1"  name="inputexp" value="<?php echo $numxpag; ?>" min="1" max="100" style="width:50px;text-align: right"/>
    <a href="#" title="ir" class="btn btn-warning elporpag">ir</a>
    <br /><br />
    
     <p>
        <?php if ((!Yii::$app->user->isGuest)&&(Yii::$app->user->identity->contabilidad==1)) { ?>
        <?= Html::a('+ Nuevo cuenta', ['create'], ['class' => 'btn btn-success']) ?>
       <?php }?>
        <?= Html::a('Listados', ['listado'], ['class' => 'btn btn-success btn-imprimir']) ?>        
    </p>

</div>
