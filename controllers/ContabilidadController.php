<?php

namespace app\controllers;

use yii\web\Controller;

class ContabilidadController extends Controller
{
   public function actionIndex()
    {
        return $this->render('index');
    }
}
