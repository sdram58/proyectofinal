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
        document.getElementById('fecha_alta').addEventListener('change',comprobarFechaBaja);
        document.getElementById('fecha_baja').addEventListener('change',comprobarFechaBaja);
        document.getElementById('tipo').addEventListener('change',comprobarFechaBaja);
    }
    
    
};
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
function ponerFechaActual(elemento){
    var f = new Date();
    document.querySelector('[name*='+elemento+']').value=(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
}

function cambiarTipo(origen,destino){
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
    var elemento = event.target;
    var f_alta = document.getElementById('fecha_alta');
    var f_baja = document.getElementById('fecha_baja');
    var tipo = document.getElementById('tipo');
    if(elemento.id==='fecha_alta'){
        if (((f_baja.value === "") || (f_baja.value > f_alta.value))&& f_alta.value !== "") {
            alert('no hacer nada');
        }else{
            alert("Error, hay que cambiar fechas");
        }      
    }
    if(elemento.id==='fecha_baja'){
        alert(f_baja.value);
        if(f_baja.value === ""){
            tipo.value='1';
        }else{
            tipo.value='2';
        }
        if (((f_baja.value === "") || (f_baja.value > f_alta.value))&& f_alta.value !== "") {
            alert('no hacer nada');
        }else{
            alert("Error, hay que cambiar fechas");
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
