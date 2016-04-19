<?php

namespace app\controllers;

use Yii;
use app\models\CategoriasObjetos;
use app\models\CategoriasObjetosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriasObjetosController implements the CRUD actions for CategoriasObjetos model.
 */
class CategoriasObjetosController extends Controller
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
     * Antes de la accion comprobamos si tiene permisos para realizarla
     * @return mixed
     */
    public function beforeAction($action) {
        $this->comprobarPermiso();
        return parent::beforeAction($action);
        
    }
    
    /**
     * Lists all CategoriasObjetos models.
     * @return mixed
     */
    public function actionIndex()
    {   
        $searchModel = new CategoriasObjetosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriasObjetos model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CategoriasObjetos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoriasObjetos();
        /*$mensaje='';
        if(isset($_POST['CategoriasObjetos[id]']) && isset($_POST['CategoriasObjetos[categoria]'])){
            //$mensaje = validaCategoria($_POST['id'],$_POST['categoria']);
            $mensaje = $_POST['CategoriasObjetos[id]'].' '.$_POST['CategoriasObjetos[categoria]'];
            if($mensaje!=''){
              return $this->render('create', [
                'model' => $model,'mensaje'=>$mensaje,
            ]);  
            }
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'mensaje'=>'',
            ]);
        }
    }

    /**
     * Updates an existing CategoriasObjetos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,'mensaje'=>'',
            ]);
        }
    }

    /**
     * Deletes an existing CategoriasObjetos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        if(($model->noTieneObjetos($id)==true) && ($model->noTieneCategorias($id)==true)){
            $model->delete();
            
        }     
        return $this->redirect(['index']);
        
    }

    /**
     * Finds the CategoriasObjetos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CategoriasObjetos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoriasObjetos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*private function checkPermisos(){
        if (!Rules::getInvitidado && Rules::getInventario()){
            return true;
        }
        return Yii::goHome();
    }*/
    
    private function comprobarPermiso(){
        if(Roles::getInvitado() || !Roles::getInventario()){
            
            return $this->redirect("index.php?r=site/nologed&pg=categorias");
        }
        return true;
    }
    

    /**
     * Comprueba si la categoria ya existe.
     * @param string $categoria
     * @return true si no existe y false en caso contrario
     */
    private function validaCategoria($id,$cat){
        $categorias = $this::find();
        $mensaje='';
        (in_array(strtoupper($id), $categorias))?$mensaje='Id ya existe':$mensaje='';
        (in_array(strtoupper($cat), $categorias))?$mensaje.='<br/>Categoria ya existe':$mensaje.='';
        
        return $mensaje;
        
    }
}
