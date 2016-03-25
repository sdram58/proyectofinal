

   <?php //echo $cabecera; 
    if(count($objetos)>0){
        $filas=0;
    foreach($objetos as $mov){   
            $filas++;
     ?>
    <div class="fila">
        <div class="uno"><?php echo $mov['id']; ?></div>
        <div class="uno"><?php echo $mov['estado']==1?'ALTA':'BAJA'; ?></div>
        <div class="dos"><?php echo $mov['ubicacion']; ?></div>
        <div class="dos"><?php echo $mov['categoria']; ?></div>
        <div class="dos"><?php echo $mov['tipo']; ?></div>
        <div class="tres"><?php echo $mov['descripcion']; ?></div>
        <div class="uno"><?php echo $mov['falta']; ?></div>
        <div class="uno"><?php echo $mov['fbaja']; ?></div>
    </div>
    
    <?php 
    
      } //Fin foreach
    }else{
        echo '<div">No se ha seleccionado ningún registro</div>';
    } 
    
    if($ultimo){ ?>
     <div class="fila cabecera">
        <div class="uno">ID</div>
        <div class="uno">Estado</div>
        <div class="dos">Ubicación</div>
        <div class="dos">Categoría</div>
        <div class="dos">Subcategoría</div>
        <div class="tres">Descripción</div>
        <div class="uno">Fecha Alta</div>
        <div class="uno">Fecha Baja</div>
    </div>
        <?php
    }
    ?>

       
       