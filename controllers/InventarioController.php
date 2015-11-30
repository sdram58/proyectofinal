<?php

namespace app\controllers;

use yii\web\Controller;

class InventarioController extends Controller
{
   public function actionIndex()
    {
        return $this->render('index');
    }
}
