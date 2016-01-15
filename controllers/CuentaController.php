<?php

namespace app\controllers;

use Yii;
use app\models\Cuenta;
use app\models\CuentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * CuentaController implements the CRUD actions for Cuenta model.
 */
class CuentaController extends Controller
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
    
    public function beforeAction($action) {
        $this->comprobarPermiso();
        return parent::beforeAction($action);
        
    }

    /**
     * Lists all Cuenta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Cuenta();        
        if ($model->load(Yii::$app->request->post()) && ($model->save())) {
           
                //Datos guardados
                unset($model);
                $model = new Cuenta();
        }
        
        $searchModel = new CuentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort =['defaultOrder' => ['id'=>SORT_DESC]];
        $dataProvider->pagination->pageSize=6;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
            'saldoA'=>$model->getSaldoA(),
            'saldoB'=>$model->getSaldoB(),
            'saldoGastosA'=>$model->getGastosA(),
            'saldoGastosB'=>$model->getGastosB(),
            'saldoIngresosA'=>$model->getIngresosA(),
            'saldoIngresosB'=>$model->getIngresosB(),
        ]);
    }

    /**
     * Displays a single Cuenta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cuenta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cuenta();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cuenta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Cuenta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->actualizarNumCuenta($id);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cuenta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cuenta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cuenta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
    
    private function comprobarPermiso(){
        if(Roles::getInvitado() || !Roles::getContabilidad()){
            
            return $this->redirect("index.php?r=site/nologed&pg=contabilidad");
        }
        return true;
    }
    
    private function actualizarNumCuenta($numcuenta){
        $comando = Yii::$app->getDb()->createCommand('UPDATE cuenta SET id=id - 1 WHERE id>'.$numcuenta);
        $comando->execute();
        
        $command = Yii::$app->db->createCommand("SELECT max(id) FROM cuenta");
        $maximo = $command->queryScalar();
        
        $comando = Yii::$app->getDb()->createCommand('ALTER TABLE cuenta AUTO_INCREMENT = :max');
        $comando->bindValue(':max', $maximo+1);
        $comando->execute();     

    }
}
