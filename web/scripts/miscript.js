/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

addEventHandler(window,'load', iniciar);

function iniciar(){
    //En función de en qué formulario estamos, iniciamos unas cosas u otras.
    
    //******************OBJETOS****************************************************************
    
    if(window.location.href.indexOf("categorias-objetos")>-1){
        if((window.location.href.indexOf("create")>-1) || (window.location.href.indexOf("update")>-1)){
          cargarCategorias();
          addEventHandler(document.getElementById('categoriasobjetos-id'),'change',comprobarIdCategoria);
          addEventHandler(document.getElementById('categoriasobjetos-categoria'),'change',comprobarCategoria);
        }
        
        $("form").submit(function (e) {
            if(!idIsOk || !categoriasIsOK){
                $('.error-envio-form').css('display','block');
                e.preventDefault();
            }
                
        });
    
    }else{
        if((window.location.href.indexOf("objeto")>-1) && (window.location.href.indexOf("imprimir")<0)){
            if(window.location.href.indexOf("create")>-1){
                ponerFechaElemento('fecha_alta');
            }
            addEventHandler(document.getElementById('input-categoria'),'change',cambiarTipo);
            addEventHandler(document.getElementById('fecha_alta'),'change',comprobarFechaBaja);
            addEventHandler(document.getElementById('fecha_baja'),'change',comprobarFechaBaja);
            addEventHandler(document.getElementById('tipo'),'change',comprobarFechaBaja);

            $("form").submit(function (e) {
                $("#div-form-error").remove();
                if ($('.error-form-label').length > 0){
                    //alert("paramos el envío");
                    if ( $("#div-form-error").length <= 0){
                        $('button').before('<div id="div-form-error" class="error-form-label">No se ha podido enviar, hay errores que ha de subsanar.</div>');
                    }                
                    e.preventDefault(); // this will prevent from submitting the form.
                }            
            });
        
    }else{
        if(window.location.href.indexOf("usuario")>-1){
        if((window.location.href.indexOf("create")>-1) || (window.location.href.indexOf("update")>-1)){
          cargarUsuarios();
          addEventHandler(document.getElementById('usuario-username'),'change',comprobarUsername);
        }
        
        $("form").submit(function (e) {
            if(!isUsuarioOk){
                $('.error-envio-form').css('display','block');
                e.preventDefault();
            }
                
        });
    }else{
        if(window.location.href.indexOf("ubicaciones")>-1){
        if((window.location.href.indexOf("create")>-1) || (window.location.href.indexOf("update")>-1)){
          cargarUbicaciones();
          addEventHandler(document.getElementById('ubicaciones-id'),'change',comprobarIdUbicacion);
          addEventHandler(document.getElementById('ubicaciones-descripcion'),'change',comprobarDescripcion);
        }
        
        $("form").submit(function (e) {
            if(!idUbicacionIsOk || !ubicacionesIsOK){
                $('.error-envio-form').css('display','block');
                e.preventDefault();
            }
                
        });
    
    }else{       
        if(window.location.href.indexOf("tipo-categorias")>-1){
        if((window.location.href.indexOf("create")>-1) || (window.location.href.indexOf("update")>-1)){
          cargarSubcategorias();
          addEventHandler(document.getElementById('tipocategorias-tipo'),'change',comprobarTipoCategoria);
          //document.getElementById('ubicaciones-descripcion').addEventListener('change',comprobarDescripcion);
        }
        
        $("form").submit(function (e) {
            if(!subcategoriasIsOK){
                $('.error-envio-form').css('display','block');
                e.preventDefault();
            }
                
        });
    
    }else{//CUENTAS*****************************************************************************************************
        if((window.location.href.indexOf("cuenta")>-1) && (window.location.href.indexOf("listado")<0)){
                 addEventHandler(document.getElementById('btnenviar'),'click',function(){
                     document.getElementById("form-cuenta").submit();
                 });
                 addEventHandler(document.getElementById('tipocuenta'),'change',cambiarCodigos);
                 cargarCodigoIngresos();
                 cargarCodigoCargos();
             }
        
        if((window.location.href.indexOf("cuenta")>-1) && (window.location.href.indexOf("listado")>-1)){
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

        }    
    }
    }
    }
    }
    }
    
    
    
    
    //Pone al elemento cuyo identificador es id, el valor de la fecha actual
    function ponerFechaElemento(id){
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;       
        document.getElementById(id).value = today;
    }
    
    function cambiarTipo(evento){
        var event = evento || window.event
        var destino='tipo-cat';
        var origen = event.target;
        var parametro = "categoria="+origen.value+"&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            var categorias = JSON.parse(JSON.stringify(eval("(" + data + ")")));
            var html="";
            $.each(categorias, function(index, element){
                html+="<option value='"+index+"'>"+element.toUpperCase()+"</option>\n";
            });
            var elemento = document.getElementById(""+destino);
            elemento.innerHTML=html;
        });
    }

    function comprobarFechaBaja(evento){        
        var event = evento || window.event
        $("#div-form-error").remove();
        var elemento = event.target;
        var f_alta = document.getElementById('fecha_alta');
        var f_baja = document.getElementById('fecha_baja');
        var tipo = document.getElementById('tipo');
        if(elemento.id==='fecha_alta'){
            $('#fecha_alta').next('div.error-form-label').remove();
            if (((f_baja.value === "") || (f_baja.value > f_alta.value))&& f_alta.value !== "") {
                //no hacer nada'
                $('.error-form').removeClass('error-form');            
                $(event.target).parent().removeClass('has-error');
                $('.error-form-label').removeClass('error-form-label');
            }else{
                $('#fecha_alta').prev().addClass('error-form-label');
                $(event.target).parent().addClass('has-error');
                $('#fecha_alta').after('<div class="error-form-label">La fecha de Alta no puede ser posterior a la fecha de Baja</div>');
                $('#fecha_alta').addClass('error-form');
            }      
        }
        if(elemento.id==='fecha_baja'){
            if(f_baja.value === ""){
                tipo.value='1';
            }else{
                tipo.value='2';
            }
           $('#fecha_baja').next('div.error-form-label').remove();
            if (((f_baja.value === "") || (f_baja.value >= f_alta.value))&& f_alta.value !== "") {
                //no hacer nada';
                $('.error-form').removeClass('error-form');
                $(event.target).parent().removeClass('has-error');
                $('.error-form-label').removeClass('error-form-label');
            }else{
                $(event.target).parent().addClass('has-error');
                $('#fecha_baja').prev().addClass('error-form-label');                
                $('#fecha_baja').after('<div class="error-form-label">La fecha de Baja no puede ser anterior a la fecha de Alta</div>');
                $('#fecha_baja').addClass('error-form');
            } 
        }
        if(elemento.id==='tipo'){
            if(tipo.value==1){
                f_baja.value="";
            }else{
                ponerFechaElemento('fecha_baja');
            }
        }
    }
    
    //**********************CATEGORIAS*******************************************************
    var categorias;
    var categoriasIsOK=true;
    var idIsOk=true;
       
    function cargarCategorias(){
        var parametro = "damecat=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            categorias = JSON.parse(JSON.stringify(eval("(" + data + ")")));
            var url =window.location.href;
            if(url.indexOf("update")>-1){
                var id= url.substring(url.indexOf('update&id=')+10);
                delete categorias[id];
            }
        });
    }
    
    function comprobarIdCategoria(evento){
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        $(event.target).parent().next().children('.error-form-label').remove();
        if(categorias[event.target.value.toUpperCase()]){          
            $(event.target).parent().next().prepend('<div class=\'error-form-label\'>El identificador \''+event.target.value+'\' ya existe</div>');
            $(event.target).parent().prev().last().addClass('error-form-label');
            idIsOk = false;
        }else{idIsOk = true;}               
    }
    
    function comprobarCategoria(evento){
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        var existe=false;
        $(event.target).parent().next().children('.error-form-label').remove();
        var key;
        for(key in categorias) {
          if(categorias.hasOwnProperty(key)) {
            if(categorias[key]===event.target.value.toUpperCase()){
                existe=true;
                break;
            }
          }
        }
        if(existe){
           $(event.target).parent().next().prepend('<div class="error-form-label catclas">La categoría \''+event.target.value+'\' ya existe</div>');
        }
        categoriasIsOK = !existe;
    }
    
    
    
    /*******USUARIOS*****************************************************************************/
    var usuarios;
    var isUsuarioOk=true;
    function cargarUsuarios(){
        var parametro = "dameusu=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            usuarios = JSON.parse(JSON.stringify(eval("(" + data + ")")));
            var url =window.location.href;
            if(url.indexOf("update")>-1){
                var id= url.substring(url.indexOf('update&id=')+10);
                delete usuarios[id];
            }
        });
    }
    
    function comprobarUsername(evento){ 
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        var existe=false;
        $(event.target).parent().next().children('.error-form-label').remove();
        var key;
        for(key in usuarios) {
          if(usuarios.hasOwnProperty(key)) {
            if(usuarios[key]===event.target.value.toUpperCase()){
                existe=true;
                break;
            }
          }
        }
        if(existe){
           $(event.target).parent().next().prepend('<div class="error-form-label catclas">El usuario \''+event.target.value+'\' ya existe</div>');
        }        
        isUsuarioOk = !existe;
    }
    
    
    
    /******UBICACIONES***************************************************************************/
    
    var ubicaciones;
    var ubicacionesIsOK=true;
    var idUbicacionIsOk=true;
       
    function cargarUbicaciones(){
        var parametro = "dameubi=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            ubicaciones = JSON.parse(JSON.stringify(eval("(" + data + ")")));
            var url =window.location.href;
            if(url.indexOf("update")>-1){
                var id= url.substring(url.indexOf('update&id=')+10);
                delete ubicaciones[id.toUpperCase()];
            }
        });
    }
    
    function comprobarIdUbicacion(evento){
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        $(event.target).parent().next().children('.error-form-label').remove();
        if(ubicaciones[event.target.value.toUpperCase()]){          
            $(event.target).parent().next().prepend('<div class=\'error-form-label\'>El identificador \''+event.target.value+'\' ya existe</div>');
            $(event.target).parent().prev().last().addClass('error-form-label');
            idUbicacionIsOk = false;
        }else{idUbicacionIsOk = true;}               
    }
    
    function comprobarDescripcion(evento){
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        var existe=false;
        $(event.target).parent().next().children('.error-form-label').remove();
        var key;
        for(key in ubicaciones) {
          if(ubicaciones.hasOwnProperty(key)) {
            if(ubicaciones[key]===event.target.value.toUpperCase()){
                existe=true;
                break;
            }
          }
        }
        if(existe){
           $(event.target).parent().next().prepend('<div class="error-form-label catclas">La Descripción \''+event.target.value+'\' ya existe</div>');           
        }      
        ubicacionesIsOK = !existe;
    }
    
    
    /*************SUBCATEGORIAS***************************************************/
    
    var subcategorias;
    var subcategoriasIsOK=true;
       
    function cargarSubcategorias(){
        var parametro = "damesubc=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            subcategorias = JSON.parse(JSON.stringify(eval("(" + data + ")")));
            var url =window.location.href;
            if(url.indexOf("update")>-1){
                var id= url.substring(url.indexOf('update&id=')+10);
                delete subcategorias[$('#tipocategorias-tipo').val()];
            }
        });
    }
    
    function comprobarTipoCategoria(evento){
        var event = evento || window.event
        $('.error-envio-form').css('display','none');
        $(event.target).parent().next().children('.error-form-label').remove();
        if(subcategorias[event.target.value.toUpperCase()]){          
            $(event.target).parent().next().prepend('<div class=\'error-form-label\'>El tipo \''+event.target.value+'\' ya existe</div>');
            $(event.target).parent().prev().last().addClass('error-form-label');
            subcategoriasIsOK = false;
            $(event.target).parent().addClass('has-error');
        }else{subcategoriasIsOK = true; $(event.target).parent().addClass('has-error');}               
    }
    
    
    //*********CUENTAS*************************************************
    var codigosCargos="";
    var codigosIngresos="";
    
    function cargarCodigoCargos(){
        var parametro = "damecg=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            codigosCargos = JSON.parse(JSON.stringify(eval("(" + data + ")")));
        });
    }
    
    function cargarCodigoIngresos(){
        var parametro = "dameci=true&nocache="+Math.random();
        $.post('index.php?r=site/ajax',parametro,function(data){
            codigosIngresos = JSON.parse(JSON.stringify(eval("(" + data + ")")));
         });
    }
    
    
    function cambiarCodigos(){
        var codigos='';
        if(document.getElementById('tipocuenta').value==0){
            codigos=codigosCargos;
        }else{
            codigos=codigosIngresos;
        }
        var html="";
        $.each(codigos, function(index, element){
           html+="<option value='"+index+"'>"+element.toUpperCase()+"</option>\n";
           });
           var elemento = document.getElementById("gastosingresos");
           elemento.innerHTML=html;

    }
    
    
    
    
    /**********LISTADOS CUENTA*******************************************************/
    
    function dragStart(e){   
        var e = e || window.event
        var dato = $(e.target).html();
        e.dataTransfer.setData('Text', e.target.id);
        e.dataTransfer.effectAllowed = 'all';
    }
    
    function dragOverAtributo(e){
        var e = e || window.event;
        if (e.preventDefault) e.preventDefault();
        var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id).hasClass('btn-atributo')
        if(tieneclase){
            $(e.target).addClass('cajaover');
            e.dataTransfer.dropEffect = 'copy';
        }
        
        return false;
    }
    
    function dragOverComparador(e){
        var e = e || window.event;
        if (e.preventDefault) e.preventDefault();
        var id = e.dataTransfer.getData('Text');
        var tieneclase=$('#'+id).hasClass('comparador')
        if(tieneclase){
            $(e.target).addClass('cajaover');
            e.dataTransfer.dropEffect = 'copy';    
        }
        
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
            }else{atributo='UPPER('+$(this).find('.btn-atributo').attr('id')+')';}
            
            
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
                        condicion='<';
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
            orderBy += 'c.'+campoOrden + ' ' + tipoOrden;
        }else {
            orderBy="";
        }
        
        if(errores>0){
            if ($('.condicion-row').length==1){
                if($('.condicion-row').find('.btn-atributo').length==0 && $('.condicion-row').find('.comparador').length==0){
                   $('#consulta').val('1 = 1 order by c.id');
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
                   $('#consulta').val('1 = 1 order by c.id');
                   $('#formfiltro').submit(); 
                   return true;
                }
            }
            $('#consulta').val(where+' '+orderBy);
            $('#formfiltro').submit();
            return true;
        }
        
        
    }
    
    
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
                sc='';
                break;            
            default:
                sc='"';
                break;
            }
        }
        
        return sc;
    }
    
    
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
  
}




//manejador de eventos multinavegador

function addEventHandler(objeto, evento, funcion){
    if(objeto.addEventListener){
        objeto.addEventListener(evento, funcion);
    }else{
        if(objeto.attachEvent)
            objeto.attachEvent("on"+evento, funcion);
    }
}


function delHandlerEvent(objeto, evento, funcion){
    if(objeto.removeEventListener){
        objeto.removeEventListener(evento, funcion);
    }else{
        if(objeto.detachEvent)
            objeto.detachEvent("on"+evento, funcion);
    }
}