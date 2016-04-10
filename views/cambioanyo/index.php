<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Cambio Contabilidad';
$this->params['breadcrumbs'][] = $this->title;
//echo $anyoactual;
//$anyoactual=$model->anyoActual;
$anyosdisponibles=$model->anyosDisponibles;
?>
<div class="row">
 <div class="col-md-5 contsettings">
 <?php $form = ActiveForm::begin([
     'action'=>'index.php?r=cambioanyo/change',
     'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}<div class=\"col-md-3\">{input}</div><div class=\"col-md-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-3',],
        ],
 ]); ?>
  <legend><span>Restaurar contabilidad anterior</span></legend>
        <?php $anyos = explode('*',$anyosdisponibles); 
        if ($anyos[0]=='NORESULT' || count($anyos)<1){
            echo '<p>No existen otras contabilidades</p>';
        }else{ 
            for($i=0;$i<count($anyos);$i++){
                $anyos2[$anyos[$i]]=$anyos[$i];
            }
            
            
            ?>
            
        
  <p>Elige el año al que quieres ir, recuerda que <strong>perderá</strong> toda la contabilidad actual</p>
        <?= $form->field($model, 'anyorestore')->dropDownList($anyos2,['id'=>'anyocont','name'=>'anyocont']) ?> 
  &nbsp; 
        <?php if($restore==0) { ?>
        <span class="col-md-6 error" style="display: none;">Ha de introducir un año válido</span>
        <?php }
        if($restore==1){ ?>
            <span class="col-md-6 error" style="display: inline;color:green">¡¡Contabilidad restaurada con éxito!!</span>
        <?php }
        if($restore==2){ ?>
            <span class="col-md-6 error" style="display: inline;color:red">Ha habido algún problema y no se ha podido restaurar!!</span>
        <?php } ?>
            <br />
        <?= Html::submitButton('Restaurar Contabilidad', ['id'=>'restaurarcont','class' => 'btn btn-success']) ?>
         <?php }
        ?>
    
 <?php ActiveForm::end(); ?>
 </div>
  <div class="col-sm-offset-1 col-md-6 contsettings">
 <?php $form = ActiveForm::begin([
     'action'=>'index.php?r=cambioanyo/guardar',
     'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}<div class=\"col-md-3\">{input}</div><div class=\"col-md-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-3',],
        ],
 ]); ?>
        <legend><span>Guardar Contabilidad</span></legend>
        <?php 
            $anyo = date('Y');
        ?>
        <p>Guarda la contabilidad actual para un año concreto, si realiza futuros cambios en la contabilidad actual, vuelva a guardarla. </p>
        <?= $form->field($model, 'anyosave')->textInput(['id'=>'guardarcomoanyos','name'=>"guardarcomo",'type'=>'number','min'=>'2000','max'=>'2090','step'=>'1','value'=>$anyo]) ?>
        &nbsp; 
        <?php if($guardadook==0) { ?>
        <span class="col-md-6 error" style="display: none;">Ha de introducir un año válido</span>
        <?php }
        if($guardadook==1){ ?>
            <span class="col-md-6 error" style="display: inline;color:green">¡¡Guardado con éxito!!</span>
        <?php }
        if($guardadook==2){ ?>
            <span class="col-md-6 error" style="display: inline;color:red">Ha habido algún problema y no se ha podido guardar!!</span>
        <?php } ?>
        <div class="form-group grupo-envio">
        <?= Html::submitButton('Guardar', ['id'=>'guardarcomo','class' => 'btn btn-success']) ?>
        
    </div>
<?php ActiveForm::end(); ?>
      </div>
</div>
  <div class="row">
  <br />
      <div class="col-md-5 contsettings">

<form>    
    <fieldset>
        <legend><span>Nueva contabilidad</span></legend>
        <p>Esta opción implica que la actual contabilidad <strong>se perderá</strong>, por favor, guárdela previamente dentro de un año válido.</p>
        <?= Html::a('Iniciar contabilidad', ['reiniciar'], ['id'=>'iniciarcont','class' => 'btn btn-success']) ?>
    </fieldset>
    
</form>
</div>
 
  <div class="col-md-offset-1 col-md-6 contsettings">
 <?php $form = ActiveForm::begin([
     'action'=>'index.php?r=cambioanyo/delete',
     'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}<div class=\"col-md-3\">{input}</div><div class=\"col-md-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-md-3',],
        ],
 ]); ?>
  <legend><span>Eliminar contabilidad guardada</span></legend>
        <?php $anyos = explode('*',$anyosdisponibles); 
        if ($anyos[0]=='NORESULT' || count($anyos)<1){
            echo '<p>No existen otras contabilidades</p>';
        }else{ 
            for($i=0;$i<count($anyos);$i++){
                $anyos2[$anyos[$i]]=$anyos[$i];
            }
            
            
            ?>
            
        
  <p>Borra la contabilidad guardada, y <strong>perderá toda la contabilidad</strong> de ese año no pudiendo recuperarla</p>
        <?= $form->field($model, 'anyorestore')->dropDownList($anyos2,['id'=>'anyocont','name'=>'anyocont']) ?>        
        <?= Html::submitButton('Eliminar Contabilidad', ['id'=>'delcont','class' => 'btn btn-success']) ?>
         <?php }
        ?>
    
 <?php ActiveForm::end(); ?>
 </div></div>
  
<script type="text/javascript">
    $('document').ready(function(){
            var guardarcomoanyos = document.getElementById('guardarcomoanyos');
            $('#guardarcomo').click(function (e){
                
                var anyo = guardarcomoanyos.value;
                if(anyo<2000 || anyo>3000){
                    $('.error').css('display','inline');
                    $('.error').css('color','red');
                    $('.error').text("Escriba un año válido");
                    e.preventDefault();
                    return false;
                }else{
                    var eliminar = confirm('Se eliminará el contenido anterior de '+ anyo +' si existe\n¿Está de acuerdo?');
                    if(!eliminar){
                        $('.error').css('display','inline');
                        $('.error').css('color','gray');
                        $('.error').text("No se ha modificado nada");
                        e.preventDefault();
                        return false; 
                    }
                    this.submit();
                }
                
                
            });
            
           $('#iniciarcont').click(function (e){
               var eliminar = confirm('Toda la contabilidad actual se perderá\nAsegurese de que la ha guardado previamente\n¿Desea continuar reiniciando una nueva contabilidad?');
                if(!eliminar){
                    e.preventDefault();
                }
           });
           
           $('#irestaurarcont').click(function (e){
               var eliminar = confirm('¿Está seguro que desea restaurar la contabilidad?\nPerderá la contabilidad actual, por favor guárdela antes.\n¿Desea continuar?');
                if(!eliminar){
                    e.preventDefault();
                }
           });
           $('#delcont').click(function (e){
               var eliminar = confirm('¿Está seguro que desea eliminar la contabilidad del año '+$('#anyocont').val() +'\n¿Pulse aceptar para continuar?');
                if(!eliminar){
                    e.preventDefault();
                }
           });
        });
</script>