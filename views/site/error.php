<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><code><?= Html::encode($this->title) ?></code></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error de arriba ocurrió mientras el servidor Web estaba procesando su petición.<br />
        Por favor, contacte con nosotros si piensa que es un error del servidor. Gracias. 
    </p>
    <p>
        
        <small>The above error occurred while the Web server was processing your request.</small><br />
         <small>Please contact us if you think this is a server error. Thank you.</small>
    </p>

</div>
