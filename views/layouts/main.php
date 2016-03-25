<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\controllers\Roles;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    <link rel="apple-touch-icon" sizes="57x57" href="./assets/image/favicon/apple-icon-57x57.png?v=1">
    <link rel="apple-touch-icon" sizes="60x60" href="./assets/image/favicona/pple-icon-60x60.png?v=1">
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/image/favicon/apple-icon-72x72.png?v=1">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/image/favicon/apple-icon-76x76.png?v=1">
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/image/favicon/apple-icon-114x114.png?v=1">
    <link rel="apple-touch-icon" sizes="120x120" href="./assets/image/favicon/apple-icon-120x120.png?v=1">
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/image/favicon/apple-icon-144x144.png?v=1">
    <link rel="apple-touch-icon" sizes="152x152" href="./assets/image/favicon/apple-icon-152x152.png?v=1">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/image/favicon/apple-icon-180x180.png?v=1"> 
    <link rel="icon" type="image/png" sizes="192x192"  href="./assets/image/favicon/android-icon-192x192.png?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/image/favicon/favicon-32x32.png?v=1">
    <link rel="icon" type="image/png" sizes="96x96" href="./assets/image/favicon/favicon-96x96.png?v=1">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/image/favicon/favicon-16x16.png?v=1">
    <link rel="manifest" href="./assets/image/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> -->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/image/favicon/favicon.ico?v=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="scripts/jquery-2.2.2.min.js" type="text/javascript"></script>
    <script src="scripts/Modernizr.js" type="text/javascript"></script>
    <script src="scripts/h5utils.js" type="text/javascript"></script>
    <script src="scripts/miscript.js" type="text/javascript"></script>    
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
 
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Gestinventabilidad',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $items = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Acerca de...', 'url' => ['/site/about']],
            ['label' => 'Contacto', 'url' => ['/site/contact']]
        ];
    
    if(!Roles::getInvitado() && Roles::getUsuario()){
        $items[]=[    
            'label' => 'Usuarios',
            'url' => ['/usuario'],
            ];
    }
            
    if (!Roles::getInvitado() && Roles::getInventario()){
            $items[]=[    
            'label' => 'Inventario',
            'items' => [
                 ['label' => 'Ubicaciones', 'url' => ['/ubicaciones']],
                 '<li class="divider"></li>',
                 //'<li class="dropdown-header">Categorias</li>',
                 ['label' => 'Categorias', 'url' => ['/categorias-objetos']],
                 ['label' => 'Subcategorias', 'url' => ['/tipo-categorias']],
            ],];
    }
            
    if (!Roles::getInvitado() && Roles::getContabilidad()){
            $items[] = [    
            'label' => 'Contabilidad',
            'items' => [
                 ['label' => 'Códigos', 'url' => ['/codigos']],
                 ['label' => 'Subcódigos', 'url' => ['/subcodigo']],                 
            ],];
    }
    
    $items[]=Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
        
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Gesti&oacute;n inventabilidad <?= date('Y') ?></p>

        <p class="pull-right">Carlos Tarazona</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
