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
    <link rel="shortcut icon" href="<?php echo Yii::$app->homeUrl.'../assets/image/inventario.png' ?>" type="image/png" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
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
                 ['label' => 'Tipo Categorias', 'url' => ['/tipo-categorias']],
            ],];
    }
            
    if (!Roles::getInvitado() && Roles::getContabilidad()){
            $items[] = [    
            'label' => 'Contabilidad',
            'items' => [
                 ['label' => 'Ubicaciones', 'url' => ['/ubicaciones']],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Categorias</li>',
                 ['label' => 'Categorias', 'url' => ['/categorias-objetos']],
                 ['label' => 'Tipo Categorias', 'url' => ['/tipo-categorias']],
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
