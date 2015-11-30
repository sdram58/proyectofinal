<?php
use yii\helpers\Html;
?>
<p>Usted ha ingresado la siguiente informacion:</p>

<ul>
    <li><label>Nombre</label>: <?= Html::encode($model->nombre) ?></li>
    <li><label>Correo</label>: <?= Html::encode($model->correo) ?></li>
</ul>