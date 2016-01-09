<?php

namespace app\controllers;

use Yii;
use app\models\TipoCategorias;
use app\models\TipoCategoriasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipoCategoriasController implements the CRUD actions for TipoCategorias model.
 */
class TipoCategoriasController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TipoCategorias models.
     * @return mixed
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->comprobarPermiso();
    }
    
    
    public function actionIndex()
    {
        //$this->comprobarPermiso();
        $searchModel = new TipoCategoriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoCategorias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$this->comprobarPermiso();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TipoCategorias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //$this->comprobarPermiso();
        $model = new TipoCategorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TipoCategorias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //$this->comprobarPermiso();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoCategorias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->comprobarPermiso();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoCategorias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoCategorias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoCategorias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    private function comprobarPermiso(){
        if(Roles::getInvitado() || !Roles::getInventario()){
            
            return $this->redirect("index.php?r=site/nologed&pg=tcategorias");
        }
        return true;
    }
}
