<?php

namespace app\controllers;

use Yii;
use app\models\Objeto;
use app\models\ObjetoSearch;
use app\models\CategoriasObjetos;
use app\models\TipoCategorias;
use app\models\Ubicaciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetoController implements the CRUD actions for Objeto model.
 */
class ObjetoController extends Controller
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
     * Lists all Objeto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estados' => $searchModel::$estados,
        ]);
    }

    /**
     * Displays a single Objeto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {     
          return $this->render('view', [
            'model' => $this->findModel($id),'noPermiso'=>(Roles::getInvitado() || !Roles::getInventario())
        ]);
    }

    /**
     * Creates a new Objeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->comprobarPermiso();
        $model = new Objeto();
        $objetos = new CategoriasObjetos();
        $categorias = $objetos->getCategorias();
        $ubicacion = new Ubicaciones();
        $ubicaciones = $ubicacion->getUbicaciones();
        $tc = new TipoCategorias();
        $tiposCategorias = $tc->getTipoCategorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'categorias'=>$categorias,'ubicaciones' => $ubicaciones,'tiposCategorias' => $tiposCategorias,'estados' => Objeto::$estados
            ]);
        }
    }

    /**
     * Updates an existing Objeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->comprobarPermiso();
        $model = $this->findModel($id);
        echo $id;
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $objetos = new CategoriasObjetos();
            $categorias = $objetos->getCategorias();
            $ubicacion = new Ubicaciones();
            $ubicaciones = $ubicacion->getUbicaciones();
            $tc = new TipoCategorias();
            $tiposCategorias = $tc->getTipoCategorias();
            
            return $this->render('update', [
                'model' => $model,'categorias'=>$categorias,'ubicaciones' => $ubicaciones,'estados' => Objeto::$estados
            ]);
        }
    }

    /**
     * Deletes an existing Objeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->comprobarPermiso();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Objeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objeto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Objeto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function comprobarPermiso(){
        if(Roles::getInvitado() || !Roles::getInventario()){
            
            return $this->redirect("index.php?r=site/nologed&pg=inventario");
        }
        return true;
    }
}

