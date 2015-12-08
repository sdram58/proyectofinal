<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Acerca de...';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Este sitio web ha sido realizado por Carlos Tarazona como proyecto final dentro del curso 2015-2016.<br />
        La aplicación gestiona la contabilidad y el inventario, de una manera muy básica y sencilla, de un centro escolar
    </p>
    
        <a class="btn-block" href="index.php" title="Volver">Volver</a>                
</div>
