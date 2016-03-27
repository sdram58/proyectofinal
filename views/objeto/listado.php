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

<script type="text/javascript">
    $(document).ready(function(){
        var comparadores = document.querySelectorAll(".comparador");
            for(var i=0;i<comparadores.length;i++){
                var comp=comparadores[i];
                addEventHandler(comp,'dragstart',dragStart);
            }
            var atributos = document.querySelectorAll(".btn-atributo");
            for(var i=0;i<atributos.length;i++){
                var comp=atributos[i];
                addEventHandler(comp,'dragstart',dragStart);
                //addEvent(comp, 'drop', dropAtributo);
            }
            
            var comparador = document.querySelectorAll(".comparador");
            for(var i=0;i<comparador.length;i++){
                var comp=comparador[i];
                addEventHandler(comp,'dragstart',dragStart);
                //addEvent(comp, 'drop', dropAtributo);
            }
            
            var atributo = document.querySelectorAll(".atributo");
           for(var i=0;i<atributo.length;i++){
                var comp=atributo[i];
                 addEventHandler(comp,'drop', dropAtributo);
                 addEventHandler(comp,'dragleave', dragLeaveAtributo);
                 addEventHandler(comp,'dragover', dragOverAtributo);
            }
            
            var condicion = document.querySelectorAll(".cond-comparador");
           for(var i=0;i<condicion.length;i++){
                var comp=condicion[i];
                 addEventHandler(comp,'drop', dropComparador);
                 addEventHandler(comp,'dragleave', dragLeaveComparador);
                 addEventHandler(comp,'dragover', dragOverComparador);
            } 
            
            $('.nueva-cond').on('click',nuevaFilaCondicion);
            //document.getElementById('hola').addEventListener('drop',dropAtributo);
            
            $('.del-cond').on('click',eliminarFilaCondicion);
            
            $('.btn-orden').on('click', seleccionarOrden);
            
            //Caja donde se añadira el atributo para el orden
            var atrCond= document.getElementById('atr-cond');
            addEventHandler(atrCond,'drop', dropAtributo);
            addEventHandler(atrCond,'dragleave', dragLeaveAtributo);
            addEventHandler(atrCond,'dragover', dragOverAtributo);
            $('#atr-cond-del').on('click',function(){
                $('#atr-cond').html('atributo');
                var atrCond= document.getElementById('atr-cond');
                $('.t_orden').children().removeClass('btn-orden-selected');
                $('#atr-cond').removeClass('cajaover');
                addEventHandler(atrCond,'drop', dropAtributo);
                addEventHandler(atrCond,'dragleave', dragLeaveAtributo);
                addEventHandler(atrCond,'dragover', dragOverAtributo);
            });
            
            $('#btn-listar').on('click',chequearCondidicion);
        
        
        
     function dragStart(e){   
        var e = e || window.event
        var dato = $(e.target).html();
        e.dataTransfer.setData('Text', e.target.id);
        e.dataTransfer.effectAllowed = 'all';
    }
    
    function dragOverAtributo(e){
        var e = e || window.event;
        if (e.preventDefault) e.preventDefault();
       /* var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id+"").hasClass('btn-atributo')
        if(tieneclase){*/
            $(e.target).addClass('cajaover');
            //e.dataTransfer.dropEffect = 'copy';
        //}
        
        return false;
    }
    
    function dragOverComparador(e){
        var e = e || window.event;
        if (e.preventDefault) e.preventDefault();
        /*var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id).hasClass('comparador')
        if(tieneclase){*/
            $(e.target).addClass('cajaover');
            e.dataTransfer.dropEffect = 'copy';    
        //}
        
        return false;
    }
    
    function dragLeaveAtributo(e){
        var e = e || window.event
        if (e.preventDefault) e.preventDefault();
        $(e.target).removeClass('cajaover');
        return false;
    }
    
    function dragLeaveComparador(e){
        var e = e || window.event
        if (e.preventDefault) e.preventDefault();
        $(e.target).removeClass('cajaover');
        return false;
    }
    
    /**
     * Acciones a tomar si se suelta algún atributo
     * @returns {Boolean}
     */
    function dropAtributo(e) {
        var e = e || window.event
        if (e.stopPropagation) e.stopPropagation(); // stops the browser from redirecting...why???
        var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id).hasClass('btn-atributo')
        if(tieneclase){
            $(e.target).addClass('cajaover');
            $(e.target).html('');
            delHandlerEvent(e.target,'drop',dropAtributo);
            delHandlerEvent(e.target,'dragleave',dragLeaveAtributo);
            delHandlerEvent(e.target,'dragover',dragOverAtributo);
            $(e.target).append($('#'+id).clone(false).attr('draggable','false').addClass('dropped'));
        }else{
            $(e.target).removeClass('cajaover');
        }
        
        generarInputs(this);    
        return false;
  }
  
  /**
   * Acciones a realizar al soltar algún comparador
   * 
   * @returns {Boolean}
   */
  function dropComparador(e) {
      var e = e || window.event
       if (e.stopPropagation) e.stopPropagation(); // stops the browser from redirecting...why???
        var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id).hasClass('comparador')
        if(tieneclase){
            $(e.target).addClass('cajaover');
            $(e.target).html('');
            delHandlerEvent(e.target,'drop',dropComparador);
            delHandlerEvent(e.target,'dragleave',dragLeaveComparador);
            delHandlerEvent(e.target,'dragover',dragOverComparador);
            //$(e.target).attr('drop',null);
            $(e.target).append($('#'+id).clone(false).attr('draggable','false').addClass('dropped'));
        }else{
            $(e.target).removeClass('cajaover');
        }
        
        generarInputs(this);
        //$(e.target).parent().next().children().first().html(campoValor);
                
        
            
        return false;
        
  }
  
  
  /**
   * Crea una nueva fila de condición
   * @returns {Boolean}
   */
  function nuevaFilaCondicion(e){
      var e = e || window.event;
      var padre =$(e.target).parents()[3];
      $(filaANDOR).insertBefore($('.ordenar').first());
      $('.andor').last().fadeOut(0);
      $('.andor').last().fadeIn(300);
    $(nuevaFila).insertBefore($('.ordenar').first());
    $('.condicion-row').last().fadeOut(0);
    $('.condicion-row').last().fadeIn(500);
    var ultimo = $('.atributo').last();
    addEvent(ultimo,'drop', dropAtributo);
    addEvent(ultimo,'dragleave', dragLeaveAtributo);
    addEvent(ultimo,'dragover', dragOverAtributo);
    
    
    var comp = $('.cond-comparador').last();
    addEvent(comp,'drop', dropComparador);
    addEvent(comp,'dragleave', dragLeaveComparador);
    addEvent(comp,'dragover', dragOverComparador);
    
    $('.nueva-cond').last().on('click',nuevaFilaCondicion);
    $('.del-cond').last().on('click',eliminarFilaCondicion);
   
   
      
    $('.btn-andor').on('click', function(){
      $(this).addClass('andor-selected');
      $(this).siblings().removeClass('andor-selected');
   });
     
    $(this).remove();
    e.preventDefault();
    return false;
  }
  
  /**
   * Elimina una fila de condicion
   * @returns {Boolean}
   */
  function eliminarFilaCondicion(e){
        var e = e || window.event
        var primerDel = document.querySelector('.del-cond');
        if(e.target.parentNode != primerDel){
            //var filacon = e.target.parentNode.parentNode.parentNode.parentNode;
            $(e.target).parents('.condicion-row').prev().first().remove();
            $(e.target).parents('.condicion-row').remove();
            
            //filacon.parentNode.removeChild(filacon);
           // $(e.target).parents()[2].remove();
        }else{          
            if($('.condicion-row').length>1){
                $(e.target).parents('.condicion-row').remove();
            }else{
            
                $(e.target).parents('.condicion-row').remove();
                $(nuevaFila).insertBefore($('.ordenar').first());
                $('.condicion-row').last().fadeOut(0);
                $('.condicion-row').last().fadeIn(500);
                var ultimo = $('.atributo').last();
                addEvent(ultimo,'drop', dropAtributo);
                addEvent(ultimo,'dragleave', dragLeaveAtributo);
                addEvent(ultimo,'dragover', dragOverAtributo);


                var comp = $('.cond-comparador').last();
                addEvent(comp,'drop', dropComparador);
                addEvent(comp,'dragleave', dragLeaveComparador);
                addEvent(comp,'dragover', dragOverComparador);

                $('.nueva-cond').last().on('click',nuevaFilaCondicion);
                $('.del-cond').last().on('click',eliminarFilaCondicion);
            }
            $('.andor').first().remove();
        }
        
        if($('.nueva-cond').length==0){
            $('.cond-accion').last().prepend('<a class="nueva-cond" title="Nueva condición"><span class="glyphicon glyphicon-plus" ></span></a>');
            $('.nueva-cond').on('click',nuevaFilaCondicion);
        }          
  
        e.preventDefault();

    }
    
    /**
    * Detecta que las condiciones sean correctas, y genera la consulta completa
    * si no hay errores

     * @param {type} elemento
     * @returns {Boolean}     */
    function chequearCondidicion(elemento){
        //alert ($(elemento).find('.btn-atributo').first().html() + ' '+$(elemento).find('.comparador').first().html() + ' ');
        var where='';
        var orderBy="order by ";
        var numCondiciones=0;
        var errores=0;
        var seplogico='';
        $('.errores').attr('display','none');
        $('.condicion-row').each(function(){
            numCondiciones++;
            var sc=''; //Separador cadena
            var atributo = $(this).find('.btn-atributo').html();
            var condicion = $(this).find('.comparador').html();
            if($('.condicion-row').length==1 && !atributo && !condicion){
                return false;
            }
            sc = detectarTipo($(this).find('.btn-atributo'));  
            if(!atributo){
                var color =$(this).find('.atributo').css('color');
                $(this).find('.atributo').css('color','red');
                $(this).find('.atributo').animate({
                    width:"+=10px",
                    height:"+=10px",
                    borderWidth:"+=2px"
                },150,"linear");
                $(this).find('.atributo').animate({
                    width:"-=10px",
                    height:"-=10px",
                    borderWidth:"-=2px"
                },150,"linear");
                
                $(this).find('.atributo').css('color',color);
                errores++;
            }else{atributo='UPPER(o.'+$(this).find('.btn-atributo').attr('id')+')';}
            
            
            if(!condicion){
                var color =$(this).find('.cond-comparador').css('color');
                $(this).find('.cond-comparador').css('color','red');
                $(this).find('.cond-comparador').animate({
                    width:"+=10px",
                    height:"+=10px",
                    borderWidth:"+=2px",
                    borderColor:"red"
                },150,"linear");
                $(this).find('.cond-comparador').animate({
                    width:"-=10px",
                    height:"-=10px",
                    borderWidth:"-=2px",
                    borderColor:"green"
                },150,"linear");
                $(this).find('.cond-comparador').css('color',color);
                errores++;
            }else{
                switch (condicion){
                    case '&lt;':
                        condicion='<';
                        break;
                    case '&gt;':
                        condicion='>';
                        break;
                    case '&lt;&gt;':
                        condicion='<>';
                        break;
                    case '&gt;=':
                        condicion='>=';
                        break;
                    case '&lt;=':
                        condicion='<=';
                        break;
                    default:
                        break;
                }
                condicion=condicion.toUpperCase();
                var valor=null;
                var valor1='a',valor2='b';
                
                if(condicion.toLowerCase()==="between"){
                    valor1 = $(this).find('.valor1').val();
                    valor2 = $(this).find('.valor2').val();
                    valor = sc+valor1+sc + ' AND ' +sc+ valor2+sc;  
                }else{
                    if (condicion==='LIKE'){
                        valor = sc+'%'+$(this).find('.input-valor').val()+'%'+sc;
                    }else{
                        valor = sc+$(this).find('.input-valor').val()+sc;
                    }
                }
                if(valor=='' || valor1=='' || valor2==''){
                    var color =$(this).find('.valor').css('borderColor');
                    $(this).find('.valor').css('borderColor','brown');
                    $(this).find('.valor').animate({
                        width:"+=10px",
                        height:"+=10px",
                        borderWidth:"+=2px"
                    },150,"linear");
                    $(this).find('.valor').animate({
                        width:"-=10px",
                        height:"-=10px",
                        borderWidth:"-=2px"
                    },150,"linear",function(){
                        
                        $(this).css('borderColor',color);
                    });
                    
                    errores++;
                }
                valor=valor.toUpperCase();
                
            }
            
           if($(this).prev().hasClass('andor')){
               if($(this).prev().find('.btn-andor').hasClass('andor-selected')==false){           
                    
                    var btnesAndor=$(this).prev().find('.btn-andor')
                    $(btnesAndor).addClass('andor-error');
                    setTimeout(function(){                        
                        $(btnesAndor).removeClass('andor-error');                    
                    },300);
                    errores++;
               }else{
               seplogico=$(this).prev().find('.andor-selected').attr('id');
           }
           }
           where += seplogico + " ";
           where += atributo + " ";
           where += condicion + " ";           
           where += valor + " ";
           
        });
        
        //ORDER BY
        var campoOrden = $('.atributo-orden').find('.btn-atributo').attr('id');
        var tipoOrden = $('.t_orden').find('.btn-orden-selected').attr('id');
        if(campoOrden && tipoOrden){
            orderBy += 'o.'+campoOrden + ' ' + tipoOrden;
        }else {
            orderBy="order by o.id asc";
        }
        
        if(errores>0){
            if ($('.condicion-row').length==1){
                if($('.condicion-row').find('.btn-atributo').length==0 && $('.condicion-row').find('.comparador').length==0){
                   $('#consulta').val('1 = 1 order by o.id');
                   //alert($('#consulta').val());
                   $('#formfiltro').submit();
                   return true;
                }
            }else{
                $('.errores').attr('display','block');
                return false;
            }           
            
            
        }else{
            if ($('.condicion-row').length==1){
                if($('.condicion-row').find('.btn-atributo').length==0 && $('.condicion-row').find('.comparador').length==0){
                   $('#consulta').val('1 = 1 order by o.id');
                   $('#formfiltro').submit(); 
                   return true;
                }
            }
            $('#consulta').val(where+' '+orderBy);
            $('#formfiltro').submit();
            //alert($('#consulta').val());
            return true;
        }
        
        
    }
    
    /**
    * En función del tipo que sea le añadirá comillas o no a la consulta

     * @param {type} elemento
     * @returns {String}     */
    function detectarTipo(elemento){
        var tipo = $(elemento).attr('tipo');
        var sc='';
        if(tipo){
            switch (tipo.toLowerCase()){
            case 'number':
                sc='';
                break;
            case 'decimal':
                sc='';
                break;
            case 'select':
                var id = $(elemento).attr('id').toLowerCase();
                if(id === "ubicacion" || id === "categoria" || id === "tipo"){
                    sc='"';
                }else
                    sc='';
                break;            
            default:
                sc='"';
                break;
            }
        }
        
        return sc;
    }
    
    
    /**
    * Genera los inputs para que el usuario coloque la información que 
    * desee en la consulta

     * @param {type} elemento
     * @returns {undefined}     */    
    function generarInputs(elemento){
        var fila= $(elemento).parents('.condicion-row');
        
        var atributo = $(fila).find('div .btn-atributo');
        var condicion = $(fila).find('div .comparador');
        if($(atributo).hasClass('btn-atributo') && $(condicion).hasClass('comparador')){
            var atr = $(atributo).html();
            var cond = $(condicion).html();
            var campo;
           // alert(cond);
            switch (cond){
                case 'Between':
                    
                    var miTipo = $(atributo).attr('tipo');
                    switch (miTipo){
                        case 'select':
                            var campo='<select class="input-valor-between valor1" name="valor1">';
                            var opciones='';
                            var miValor = $(atributo).attr('mivalor');
                            var misValores=new Array();
                            misValores = miValor.split('_');
                            misValores.forEach(function (element,index,array){
                                var valores=element.split(':');
                                opciones+='<option value="'+valores[0]+'">'+valores[1]+'</option>';
                            });
                            campo+=opciones + '</select> Y <select class="input-valor-between valor2" name="valor2">'+opciones+'</select>';
                            
                            
                            break;
                        case 'decimal':
                           campo = '<input class="input-valor-between valor1" type="number" step="any" name="valor1">'
                           campo += ' y <input class="input-valor-between valor2" type="number" step="any" name="valor2">';
                            break;
                        default:
                            campo = '<input class="input-valor-between valor1" type="'+miTipo+'" name="valor1"> y <input class="input-valor-between valor2" type="'+miTipo+'" name="valor2">';                            
                    }                    
                    break;
                default: 
                    campo = '<input class="input-valor" type="number" step="any" name="valor">';
                    var miTipo = $(atributo).attr('tipo');
                    switch (miTipo){
                        case 'select':
                            campo='<select class="input-valor valor1" name="valor1">';
                            var miValor = $(atributo).attr('mivalor');
                            var misValores=new Array();
                            misValores = miValor.split('_');
                            misValores.forEach(function (element,index,array){
                                var valores=element.split(':');
                                campo+='<option value="'+valores[0]+'">'+valores[1]+'</option>';
                            });
                            
                            campo+='</select>';                            
   
                            break;
                        case 'decimal':
                            campo = '<input class="input-valor" type="number" step="any" name="valor1">';
                            break;
                        default:
                            campo = '<input class="input-valor" type="'+miTipo+'" name="valor1">';
                    }                 
            }
            
            

            //$(fila).find('.valor').html(campo);
            
            $(fila).find('.valor').html(campo).addClass('cajaover');
        }else{
            //alert('falta uno');
        }
    }
    
    function seleccionarOrden(e){
        var e = e || window.event
        
        $(e.target).addClass('btn-orden-selected');
        $(e.target).siblings('.btn-orden').removeClass('btn-orden-selected');
    }
  
  
  var nuevaFila='<div class="row condicion-row">';
      nuevaFila+='<div class="col-xs-4">';
      nuevaFila+='<div class="cond-atributo atributo">';
      nuevaFila+='atributo';
      nuevaFila+='</div>';
      nuevaFila+='</div>';
      nuevaFila+='<div class="col-xs-2">';
      nuevaFila+='<div class="cond-atributo cond-comparador">';
      nuevaFila+='Comparador';
      nuevaFila+='</div>';
      nuevaFila+='</div>';
      nuevaFila+='<div class="col-xs-5">';
      nuevaFila+='<div class="cond-atributo valor">';
      nuevaFila+='Valor';
      nuevaFila+='</div>';
      nuevaFila+='</div>';
      nuevaFila+='<div class="col-xs-1">';
      nuevaFila+='<div class="cond-accion">';
      nuevaFila+='<a class="nueva-cond" title="Nueva condición"><span class="glyphicon glyphicon-plus" ></span></a> '  ; 
      nuevaFila+='<a class="del-cond" title="Eliminar condición"><span class="glyphicon glyphicon-remove"></span></a>';
      nuevaFila+='</div>';
      nuevaFila+='</div>';
      nuevaFila+='</div>';
      
    
    var filaANDOR='<div class="row andor"><div class="col-xs-12"><span id="AND" title="Y" class="btn-andor and">Y</span><span id="OR" title="O" class="btn-andor or">O</span></div>"';
    });
</script>




