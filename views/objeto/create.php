<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = 'Crear Objeto';
$this->params['breadcrumbs'][] = ['label' => 'Objetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="objeto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'categorias' => $categorias, 'ubicaciones'=>$ubicaciones, 'tiposCategorias' => $tiposCategorias, 'estados' => $estados
    ]) ?>
    
    

</div>
