<?php

namespace app\controllers;

use Yii;
use app\models\Cuenta;
use app\models\CuentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;


/**
 * CuentaController implements the CRUD actions for Cuenta model.
 */
class CuentaController extends Controller
{
    private static $CABECERA = '<table id="tabla"><caption>Movimientos 2015</caption><tr>
        <th rowspan="3" class="centrado table-header">Nº Orden</th>
        <th class="centrado table-header" rowspan="3">Fecha</th>
        <th class="centrado table-header" rowspan="3">Recurso A/B</th>
        <th class="centrado table-header" rowspan="3">Código de gastos</th>
        <th class="centrado table-header" rowspan="3">Explicación de los ingresos y de los gastos</th>
        <th class="centrado table-header" rowspan="3">Importe de los ingresos</th>
        <th class="centrado table-header" colspan="11">Importe de los gastos según concepto</th>

        <th class="centrado table-header" rowspan="3">SALDO A</th>
        <th class="centrado table-header" rowspan="3">SALDO B</th>
    </tr>
     <tr>                   
        <th class="centrado table-header" colspan="4">Reparación y conservación</th>

        <th class="centrado table-header" rowspan="2">Suministro</th>
        <th class="centrado table-header" rowspan="2">Transporte y comunicación</th>
        <th class="centrado table-header" rowspan="2">Trabajo por otros</th>
        <th class="centrado table-header" rowspan="2">Material oficina</th>
        <th class="centrado table-header" rowspan="2">Mobiliario y equipo</th>
        <th class="centrado table-header" rowspan="2">Dietas y locomocion</th>
        <th class="centrado table-header" rowspan="2">Diversos</th>
    </tr>
     <tr>                  
        <th class="centrado table-header">Edificación y contrstucción</th>
        <th class="centrado table-header">Maquinaria Instalación Util.</th>
        <th class="centrado table-header">Movil Enseres</th>
        <th class="centrado table-header">Equipos Procesos Informático</th>

    </tr>';
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
            $model::getDb()->createCommand("call actualizarSaldoActual('');")->execute();
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
     * Pagina para filtrar campos y delver inform
     */
    
    public function actionListado(){
        $model = new Cuenta();
        if(Yii::$app->request->post('consulta')!=NULL){           
            $this->layout = 'printlayout';
            $pdf = new mPDF('utf-8','A4-L',0,'',10,10,10,10);
            $movimientos = $model->getListado(Yii::$app->request->post('consulta'));
            $movPerPage=10;
            $misMovimientos = array_chunk($movimientos,$movPerPage,true);
            $numPages = count($misMovimientos);
            foreach($misMovimientos as $key=>$valor){
                $ultimo=false;
                if(($key+1)==$numPages){
                    $ultimo=true;
                }
                $content = $this->render('imprimir', [
                'model' => $model,'movimientos'=>$valor,'mpdf'=>$pdf,'ultimo'=>$ultimo,
                ]);
                //$pdf->SetHeader('Movimientos del año 2015');
                $pdf->SetHTMLHeader($this::$CABECERA,'',true);
                $pdf->SetFooter('Página '.($key+1).' de '.$numPages.'->'.'{PAGENO}');
                $pdf->WriteHTML($content);
                
                if(!$ultimo){
                    $pdf->AddPage();
                }
            }
            
            $pdf->Output();
            exit;
   
  
            
            /****************************************************************************************/
 
        }
        /**Pagina de filtrado************************/
        return $this->render('listado', [
                'model' => $model, 'tipos'=>$model->getTipos(),
            ]);
    }
    
    public function actionImprimir(){
        $model = new Cuenta();
        $post = '';//Yii::$app->request->post();
        return $this->render('imprimir', [
                'model' => $model, 'datos'=>$post,
            ]);
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
        $comando = Cuenta::getDb()->createCommand('UPDATE cuenta SET id=id - 1 WHERE id>'.$numcuenta);
        $comando->execute();
        
        $command = Cuenta::getDb()->createCommand("SELECT max(id) FROM cuenta");
        $maximo = $command->queryScalar();
        
        $comando = Cuenta::getDb()->createCommand('ALTER TABLE cuenta AUTO_INCREMENT = :max');
        $comando->bindValue(':max', $maximo+1);
        $comando->execute();     

    }
}
