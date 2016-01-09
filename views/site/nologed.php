<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\models\Nologed;

$this->title = $model->getTitulo();
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($model->getMensaje())) ?>
        <br /><br /><br />
        <div class="redireccion">Será redirigido a la página inicial en <span><?php echo $model->getTiempo() ?></span> segundos</div>
    </div>

    <p>
        El mensaje de arriba ocurrió mientras el servidor Web estaba procesando su respuesta.
        <!-- The above error occurred while the Web server was processing your request.-->
    </p>
    <p>
        Por favor, contacte con nosotros si piensa que es una error del servidro. Gracias.
        <!--Please contact us if you think this is a server error. Thank you.-->
    </p>
    <br />
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success','style'=>'margin-left:45%;']) ?>
    <script>
	function r() { location.href="index.php" } 
	setTimeout ("r()", <?php echo $model->getTiempo()*1000 ?>);
        function a(){
            var span = document.querySelector(".redireccion span");
            var segundos = span.innerHTML;
            span.innerHTML =segundos - 1;
            if (segundos <= 1) {clearInterval(intervalo);}            
        }
        var intervalo = setInterval("a()",1000);
    </script>

</div>