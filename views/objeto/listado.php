<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Filtrado Inventario';
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="wraplistadoconteido">
    <div class="row comparadores">
        
            <div class="col-xs-4" >
                <h3 style='text-align:right;position:relative;top:-15px;'>Comparadores:</h3>
            </div>
        <div class="col-xs-1" >
            <div id="igual" class="btn btn-primary comparador" title="Igual" draggable="true">=</div>
        </div>
        
        <div class="col-xs-1">
            <div id="distinto" class="btn btn-primary comparador" title="Distinto" draggable="true"><></div>          
        </div>
        <div class="col-xs-1">
            <div id="menorque" class="btn btn-primary comparador" title="Menor que" draggable="true"><</div>          
        </div>
        <div class="col-xs-1">
            <div id="mayorque" class="btn btn-primary comparador" title="Mayor que" draggable="true">></div>          
        </div>
        <div class="col-xs-1">
            <div id="menoroigual" class="btn btn-primary comparador" title="Menor o igual" draggable="true"><=</div>         
        </div>
        <div class="col-xs-1">
            <div id="mayoroigual" class="btn btn-primary comparador" title="Mayor o igual" draggable="true">>=</div>          
        </div>
        <div class="col-xs-1">
            <div id="contiene" class="btn btn-primary comparador" title="Contiene" draggable="true">Like</div>           
        </div>
        <div class="col-xs-1">
            <div id="entre" class="btn btn-primary comparador" title="Entre" draggable="true">Between</div>           
        </div>
        
    </div>
    
</div>
<div class="row">
    <div class="col-xs-2 listado-campos">
        <h3>Atributos</h3>
        <?php foreach($model->attributeLabels() as $key=>$valor){
            $tipo='';
            $mivalor='';
                if (is_array($tipos[$valor])){
                    $tipo='select';
                    foreach($tipos[$valor] as $clave=>$val){
                        $mivalor.=$clave.':'.$val.'_';
                    }
                    $mivalor=substr($mivalor,0,strlen($mivalor)-1);
                }else{
                    $tipo = $tipos[$valor];
                }
                echo '<div tipo="'.$tipo.'" mivalor="'.$mivalor.'"class="btn btn-success btn-atributo" id="'.$key.'" draggable="true">'.$valor.'</div><br />';
        }?>
    </div>
    <div class="col-xs-10 condicion">
        <div class="row condicion-row">
            <div class="col-xs-4">
                <div class="cond-atributo atributo">
                    atributo
                </div>
                
            </div>
            <div class="col-xs-2">
                <div class="cond-atributo cond-comparador">
                    Comparador
                </div>
                
            </div>
            <div class="col-xs-5">
                <div class="cond-atributo valor">
                    Valor
                </div>
            </div>
            <div class="col-xs-1">
                <div class="cond-accion">
                    <a class="nueva-cond" title="Nueva condición"><span class="glyphicon glyphicon-plus" ></span></a>    
                    <a class="del-cond" title="Eliminar condición"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                
            </div>
        </div>
        
        <div class="row ordenar">
            <h3>ORDEN</h3><br />
            <div class="ordenar">
                <div id="atr-cond" class="col-xs-3 col-xs-offset-2 cond-atributo atributo-orden">
                    atributo
                </div>
                <div class="col-xs-5 t_orden">
                    <div id="asc" class="btn btn-primary btn-orden" title="Orden Ascendente A-Z">Ascendente</div>
                    <div id="desc" class="btn btn-primary btn-orden" title="Orden Descendente Z-A">Descendente</div>                    
                </div>
                <div class="col-xs-1">
                    <div class="cond-accion2">                            
                        <a id="atr-cond-del" class="del-orden" title="Eliminar orden"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>                
                </div>
            </div>
        </div>
        <div class="row">
            <div class="errores">Hay errores en las consultas, <br> Debe haber campos o atributos incompletos.</div>
        </div>
        <div class="row listar">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'formfiltro']]); ?>
                <input id="consulta" name="consulta" type="hidden"></input>
                <div id="btn-listar" class="btn btn-primary" title="Imprimir Listado">Imprimir Listado</div>
            </form><?php ActiveForm::end(); ?>
            
        </div>
        
            
    </div>
</div>




