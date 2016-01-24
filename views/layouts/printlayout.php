<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php //$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Listado movimientos</title>
    <link rel="stylesheet" href="css/print.css" />
    <script src="scripts/miscript.js" type="text/javascript"></script>
    <?php $this->head() ?>
    
</head>
<body>

   <div class="container">
        <?= $content ?>
    </div>
</div>

</body>
</html>
<?php //$this->endPage() ?>
