<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Países</h1>
<ul>
<?php foreach ($paises as $pais): ?>
    <li>
        <?= Html::encode("{$pais->nombre} ({$pais->codigo})") ?>:
        <?= $pais->poblacion ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>