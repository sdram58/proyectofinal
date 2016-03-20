<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="duplicar">
    <form name="dupform" method="post" action="#">
        <div class="div-cerrar"><a id="btn-cerrar" class="glyphicon glyphicon-eye-close btn-cerrar" title="Cerrar"></a></div>
        <span>Escriba la cantidad de veces que quiere duplicar el registro</span><br />
        X <input id="dupnumber" type="number" name="cantidad" min="1" max="100" step="1" value="1" /> &nbsp;
        <input id="idobjeto" type="hidden" value="<?php 
            if (isset($model->id)){
                echo $model->id;
            }else{
                echo -1;
            }
        ?>" name="<?php 
            if (isset($model->id)){
                echo "vista";
            }else{
                echo "listado";
            }
        ?>" />
        <input id="btn-duplicar" type="button" class="btn btn-warning" value="Duplicar">
    </form>
    <div class="mensajes"></div>
</div>
<script type="text/javascript">
    $('#btn-cerrar').click(function(){
        $(".duplicar").fadeOut(400);
        $(".duplicar").css({"display":"none"});
    });
    $('.btn-duplicar').click(function(e){
        e.preventDefault();
        var numObjeto;
           
        
        $(".duplicar").fadeIn(400);
        $(".mensajes").css({"display":"none"});
        if($('#idobjeto').attr("name")==="listado"){
            numObjeto = e.target.id;
            $('#idobjeto').val(numObjeto);
            var offsetLeft=e.pageX-$(".duplicar").width()-10;
            /*$(".duplicar").css({"position":normal});
            $(".duplicar").css({"position":absolute});*/
            $(".duplicar").css({"top":e.pageY+'px',"left":offsetLeft+'px'});
            
        } 
        $(".mensajes").html('');
    });
    
   /* $( ".btn-duplicar" ).mousedown(
            function( event ) {
                $(".mensajes").css({"display":"block"});
                $(".mensajes").html('<p>'+event.clientY+','+ event.clientX+'</p>');
                $(".duplicar").css({"top":event.clientY+'px',"left":event.clientX+'px'});
                //$('.btn-duplicar').click();
            }
    );*/
    
    $('#btn-duplicar').click(function(e){        
        e.preventDefault();
        $(".mensajes").css({"display":"block"});
        $(".mensajes").html('<img src="assets/images/loading.gif" width="80"/>');
        var cantidad = $('#dupnumber').val();
        cantidad = Math.floor(cantidad);
        var id=$('#idobjeto').val();
        var parametro = {'duplicar':true, 'id':id, 'cantidad':cantidad,'nocache':Math.random()};
        //alert(parametro);
        $.ajax({
            url:'index.php?r=site/ajax',
            data:parametro,
            timeout:8000,
            success:function(data){                
                $(".mensajes").html(data);
                $(".mensajes").css({"display":"block","color":"green"});
                $('#dupnumber').val(0);
                if($('#idobjeto').attr("name")==="listado"){
                    setTimeout(function(){ window.location.href=window.location.href;},2000);
                }
            },
            type:"POST",
            error : function(xhr, status) {
                alert('error');
                $(".mensajes").html('Disculpe, existió un problema');
                $(".mensajes").css({"display":"block","color":"red"});;
            },
        });
        //document.location.href = document.location.href;
    });
    
    function recargar(){
        
    }
    
</script>
        
