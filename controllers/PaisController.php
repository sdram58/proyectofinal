<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Pais;

class PaisController extends Controller
{
    public function actionIndex()
    {
        $query = Pais::find();

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $paises = $query->orderBy('nombre')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'paises' => $paises,
            'pagination' => $pagination,
        ]);
    }
}
