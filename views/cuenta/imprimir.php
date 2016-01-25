<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<br>
<?php $cabecera='<tr>
        <th rowspan="3" class="centrado table-header">Número Orden</th>
        <th class="centrado table-header" rowspan="3">Fecha</th>
        <th class="centrado table-header" rowspan="3">Recurso A/B</th>
        <th class="centrado table-header" rowspan="3">Código de gastos</th>
        <th class="centrado table-header" rowspan="3">Explicación de los ingresos y de los gastos</th>
        <th class="centrado table-header" rowspan="3">Importe de los ingresos</th>
        <th class="centrado table-header" colspan="11">Importe de los gastos según concepto</th>

        <th class="centrado table-header" rowspan="3">SALDO A</th>
        <th class="centrado table-header" rowspan="3">SALDO B</th>
    </tr>
     <tr>                   
        <th class="centrado table-header" colspan="4">Reparación y conservación</th>

        <th class="centrado table-header" rowspan="2">Suministro</th>
        <th class="centrado table-header" rowspan="2">Transporte y comunicación</th>
        <th class="centrado table-header" rowspan="2">Trabajo por otros</th>
        <th class="centrado table-header" rowspan="2">Material oficina</th>
        <th class="centrado table-header" rowspan="2">Mobiliario y equipo</th>
        <th class="centrado table-header" rowspan="2">Dietas y locomocion</th>
        <th class="centrado table-header" rowspan="2">Diversos</th>
    </tr>
     <tr>                  
        <th class="centrado table-header">Edificación y contrstucción</th>
        <th class="centrado table-header">Maquinaria Instalación Util.</th>
        <th class="centrado table-header">Movil Enseres</th>
        <th class="centrado table-header">Equipos Procesos Informático</th>

    </tr>'; ?>
<table id="tabla">    

    <?php 
    echo $cabecera;
    if(count($movimientos)>0){
        $filas=0;
        foreach($movimientos as $mov){   
            $filas++;
?>
    <tr>
        <td class="centrado"><?php echo $mov['id']; ?></td><!--Numero de orden ID-->
        <td class="centrado"><?php $aa=substr($mov['fecha'],0,4); $mm=substr($mov['fecha'],5,2); $dd=substr($mov['fecha'],8,2); echo $dd.'-'.$mm.'-'.$aa; ?></td><!--fecha fecha-->
        <td class="centrado"><?php echo $mov['tipocuenta']==0?'A':'B'; ?></td><!--Cuenta A o B -->
        <td class="centrado">
            <?php 
            echo ($mov['gastoingreso']==0)?$mov['codigo'].'.'.$mov['identificador']:''; 
            ?>
        </td><!--Codigo Gastos si gasto-->
        <td class="centrado"><?php echo $mov['descripcion']; ?></td><!--Explicación Gastos o ingresos Descripcion -->
        <td class="derecha"><?php if($mov['gastoingreso']==1) echo  number_format($mov['saldo'],2,'.',','); ?></td><!--saldo si ingreso-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==1 && $mov['identificador']==1) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Ed Constr 1.1-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==1 && $mov['identificador']==2) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Ed Constr 1.2-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==1 && $mov['identificador']==3) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Ed Constr 1.3-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==1 && $mov['identificador']==4) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Ed Constr 1.4-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==2) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Sumnistros 2 -->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==3) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Transporte 3 -->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==4) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Trabajo para otros 4-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==5 && $mov['codigo']==5) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Materia Oficina 5 -->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==6) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Mobiliario y equip. 6 -->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==7) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Ed Constr 1.1-->
        <td class="derecha">
            <?php if($mov['gastoingreso']==0 && $mov['codigo']==8) echo  number_format($mov['saldo'],2,'.',','); ?>
        </td><!--saldo si gasto. Diversos 8 -->
        <td class="derecha"><?php echo $mov['tipocuenta']==0?number_format($mov['saldoactual'],2,'.',','):''; ?></td><!--Saldo A-->
        <td class="derecha"><?php echo $mov['tipocuenta']==0?'':number_format($mov['saldoactual'],2,'.',','); ?></td><!--Saldo B-->
    </tr>
    <?php 
        if($filas>5){
            //$mpdf->AddPage();
            echo '<p style="page-break-after:always"></p>';
            echo $cabecera;
            $filas=0;
        }//Fin salto de página
    
      } //Fin foreach
    }else{
        echo '<tr><td class="centrado" colspan="19">No se ha seleccionado ningún registro</td></tr>';
    } ?>
    <!--PIE TABLA -->
    <tr class="table-foot">
        <td colspan="5" rowspan="2"></td>
        <td colspan="2">Saldo Ingresos A:</td>
        <td colspan="2">Saldro Ingresos B:</td>
        <td colspan="2">Salgo Gastos A:</td>
        <td colspan="2">Salgo Gastos B:</td>
        <td colspan="2">Saldo TotalA:</td>
        <td colspan="2">Saldo TotalB:</td>
        <td colspan="2">Saldo Total:</td>
    </tr>
     <tr class="table-foot">
        <td colspan="2"><?php echo number_format($model->getIngresosA(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php echo number_format($model->getIngresosB(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php echo number_format($model->getGastosA(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php echo number_format($model->getGastosB(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php echo number_format($model->getSaldoA(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php echo number_format($model->getSaldoB(),2,'.',',').'€'; ?></td>
        <td colspan="2"><?php $total = $model->getSaldoA()+$model->getSaldoB(); echo number_format($total,2,'.',',').'€'; ?></td>
    </tr>

</table>


<!--SELECT SUM(saldo) FROM cuenta WHERE tipocuenta=0 and gastoingreso=0
SELECT SUM(saldo) FROM cuenta WHERE tipocuenta=1
DELIMITER //
CREATE TRIGGER saldoActual BEFORE INSERT ON cuenta
FOR EACH ROW
BEGIN
DECLARE ingresoanterior double;
DECLARE gastoanterior double;
SET ingresoanterior = SELECT SUM(saldo) FROM cuenta WHERE tipocuenta=NEW.tipocuenta AND gastoingreso=1 AND YEAR(fecha)=YEAR(NEW.fecha);
SET gastoanterior = SELECT SUM(saldo) FROM cuenta WHERE tipocuenta=NEW.tipocuenta AND gastoingreso=0  AND YEAR(fecha)=YEAR(NEW.fecha);
IF NEW.gastoingreso > 0 THEN
	SET NEW.saldoactual=ingresoanterior-gastoanterior+NEW.saldo;
   ELSE 
   SET NEW.saldoactual=ingresoanterior-gastoanterior-NEW.saldo;
END IF;
END; //
DELIMITER ;

DELIMITER //
CREATE TRIGGER saldoActualAfter AFTER INSERT ON cuenta
FOR EACH ROW
BEGIN
DECLARE ingresoanterior double;
DECLARE gastoanterior double;
SELECT SUM(saldo) into ingresoanterior FROM cuenta WHERE tipocuenta=NEW.tipocuenta AND gastoingreso=1 AND YEAR(fecha)=YEAR(NEW.fecha);
SELECT SUM(saldo) INTO gastoanterior FROM cuenta WHERE tipocuenta=NEW.tipocuenta AND gastoingreso=0  AND YEAR(fecha)=YEAR(NEW.fecha);
IF NEW.gastoingreso > 0 THEN
	UPDATE cuenta SET saldoactual=(ingresoanterior-gastoanterior+NEW.saldo) WHERE id=NEW.id;
   ELSE 
   	UPDATE cuenta SET saldoactual=(ingresoanterior-gastoanterior-NEW.saldo) WHERE id=NEW.id;
END IF;
END; //
DELIMITER ;
-->