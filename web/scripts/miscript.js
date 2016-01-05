/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

window.addEventListener('load', iniciar);

function iniciar(){
    //En función de en qué formulario estamos, iniciamos unas cosas u otras.
    if(window.location.href.indexOf("objeto")>-1){
        if(window.location.href.indexOf("create")>-1){
            ponerFechaElemento('fecha_alta');
        }
        document.getElementById('input-categoria').addEventListener('change',cambiarTipo);
        document.getElementById('fecha_alta').addEventListener('change',comprobarFechaBaja);
        document.getElementById('fecha_baja').addEventListener('change',comprobarFechaBaja);
        document.getElementById('tipo').addEventListener('change',comprobarFechaBaja);
        
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
    
    function cambiarTipo(event){
        var destino='tipo-cat';
        var origen = event.target;
        parametro = "categoria="+origen.value+"&nocache="+Math.random();
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

    function comprobarFechaBaja(event){
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
                
                $('.error-form-label').removeClass('error-form-label');
            }else{
                $('#fecha_alta').prev().addClass('error-form-label');
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
                
                $('.error-form-label').removeClass('error-form-label');
            }else{
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
    
    
    
}

