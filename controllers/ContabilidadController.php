<?php

namespace app\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ContabilidadController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index','create','delete','update'],
                        'allow' => true,
                        'roles' => ['@'],//[@] usuarios logeados, [?] todos
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
   public function actionIndex()
    {
        return $this->render('index');
    }
}
