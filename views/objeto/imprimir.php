

<?php 
use yii\grid\GridView;
$this->title="impresion";?>
<header>Listado de inventario según criterio <?php echo date('d-m-Y',time()); ?> </header>
        ?>
<?php foreach($dataProvider as $key=>$value){
    echo "-".$key."=>".$value."<br />";
} ?>