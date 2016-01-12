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
use kartik\mpdf\Pdf;


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
        $dataProvider->pagination->pageSize=5;
       
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
     * Muestra las opciones para buscar
     */
    public function actionListado(){
        $searchModel = new ObjetoSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
       
        return $this->render('listado', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estados' => $searchModel::$estados,
        ]);
    }
    
    /**
     * Imprime en pdf
     */
    public function actionImprimir(){
        /*Yii::$app->response->format = 'pdf';

        // Rotate the page
        Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
            'format' => [216, 356], // Legal page size in mm
            'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
            'beforeRender' => function($mpdf, $data) {},
            ]);*/

        $this->layout = 'printlayout';
        
        $searchModel = new ObjetoSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // $dataProvider->pagination->pageSize=5;
       
        return $this->render('imprimir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estados' => $searchModel::$estados,
        ]);
        //return $this->render('imprimir', []);
        
        
       /* 
        $this->layout = 'printlayout';
        $content = $this->renderPartial('imprimir');
 
    // setup kartik\mpdf\Pdf component
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_UTF8, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:18px}', 
         // set mPDF properties on the fly
        'options' => ['title' => 'Krajee Report Title'],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['Krajee Report Header'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);*/
 
    // return the pdf output as per the destination setting
    return $pdf->render();
        
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

