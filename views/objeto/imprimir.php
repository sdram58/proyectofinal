<?php
$CABECERA='<table><tr class="fila cabecera">
    <th class="uno">ID</th>
    <th class="uno">Estado</th>
    <th class="dos">Ubicación</th>
    <th class="dos">Categoría</th>
    <th class="dos">Subcategoría</th>
    <th class="tres">Descripción(S/N)</th>
    <th class="uno">Fecha Alta</th>
    <th class="uno">Fecha Baja</th>
</tr>';

 
    echo $CABECERA; 
    if(count($objetos)>0){
        $filas=0;
    foreach($objetos as $mov){   
            $filas++;
     ?>
    <tr class="fila">
        <td class="uno"><?php echo $mov['id']; ?></td>
        <td class="uno"><?php echo $mov['estado']==1?'ALTA':'BAJA'; ?></td>
        <td class="dos"><?php echo $mov['ubicacion']; ?></td>
        <td class="dos"><?php echo $mov['categoria']; ?></td>
        <td class="dos"><?php echo $mov['tipo']; ?></td>
        <td class="tres"><?php echo $mov['descripcion']===null?" ":$mov['descripcion']; ?></td>
        <td class="uno"><?php echo $mov['falta']; ?></td>
        <td class="uno"><?php echo $mov['fbaja']===null?" ":$mov['fbaja']; ?></td>
    </tr>
    
    <?php 
    
      } //Fin foreach
      
      echo "</table>";
    }else{
        echo '<tr><td>No se ha seleccionado ningún registro</td></tr>';
    } 
    
    if($ultimo){ ?>
    <div></div>
    <div class="footer">Total Elementos listados: <?php echo $total; ?> </div>
        <?php
    }
    ?>
<script type="text/javascript">
    /*var filas=document.querySelectorAll(".fila");
    
    for(var i=0;i<filas.length;i++){
         var hijos = filas[i].querySelectorAll("div");
         var divHeight=0;
          var obj = filas[i];

            if(obj.offsetHeight){divHeight=obj.offsetHeight;}
            else if(obj.style.pixelHeight){divHeight=obj.style.pixelHeight;}
            
         for(var j=0;j<hijos.length;j++){
             var alturahijo;
             var obj = hijos[i];
             if(obj.offsetHeight){alturahijo=obj.offsetHeight;}
             else if(obj.style.pixelHeight){alturahijo=obj.style.pixelHeight;}
             
             if(divHeight<alturahijo){
                 divHeight=alturahijo;
             }
         }
         filas[i].style.height=divHeight+"px";
    }*/
            
</script>
       
       