<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>
<div class="wraplistadoconteido">
    <div class="row comparadores">
        
            <div class="col-xs-4" >
                <h3>Comparadores:</h3>
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
            <div id="mayorque" class="btn btn-primary comparador" title="Mayor que" draggable="true"><</div>          
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
                echo '<div class="btn btn-success btn-atributo" id="'.$key.'" draggable="true">'.$valor.'</div><br />';
        }?>
    </div>
    <div class="col-xs-10 condicion">
        <div class="row condicion-row">
            <div class="col-xs-4">
                <div class="cond-atributo atributo">
                    atributo
                </div>
                
            </div>
            <div class="col-xs-3">
                <div class="cond-atributo cond-comparador">
                    Comparador
                </div>
                
            </div>
            <div class="col-xs-4">
                <div class="valor">
                    Valor
                </div>
            </div>
            <div class="col-xs-1">
                <div class="cond-accion">
                    <a class="nueva-cond" title="Nueva condición"><span class="glyphicon glyphicon-arrow-down" ></span></a>    
                    <a class="del-cond" title="Eliminar condición"><span class="glyphicon glyphicon-erase"></span></a>
                </div>
                
            </div>
        </div>
        
        <div class="row ordenar">
            <h3>ORDEN</h3><br />
            <div class="ordenar">
                <div class="col-xs-4 cond-atributo">
                    atributo
                </div>
                <div class="t_orden">
                    <select class="t_orden">
                        <option value="asc">ASCENDENTE</option>
                        <option value="desc">DESCENDENTE</option>
                    </select>
                </div>
            </div>
        </div>
            
    </div>
</div>

<div id="hola" class atributo>
                    atributo<br><br>fesf
</div>



