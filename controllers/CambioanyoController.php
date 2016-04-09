<?php

namespace app\controllers;

use Yii;
use app\models\Codigos;
use app\models\CambioAnyo;
use app\models\Cuenta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * CodigosController implements the CRUD actions for Codigos model.
 */
class CambioanyoController extends Controller
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
     * Lists all Codigos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelo = new CambioAnyo();
        
        $modelo->anyoActual = Cuenta::getDb()->createCommand( 'SELECT contActual()' )->queryScalar();
        $modelo->anyosDisponibles=Cuenta::getDb()->createCommand( 'SELECT dameTablasAnyos()' )->queryScalar();

        return $this->render('index',['model'=>$modelo,'guardadook'=>'0','restore'=>'0',
            ]);
    }

    /**
     * Cambia la tabla cuentas por la de otro año que exista
     * Borrará la contabilidad actual
     */
    public function actionChange(){
        $modelo = new CambioAnyo();
        $anyo=NULL;
       $anyo= Yii::$app->request->post('anyocont');
       if($anyo==NULL){
           $modelo->anyoActual = Cuenta::getDb()->createCommand( 'SELECT contActual()' )->queryScalar();
           $modelo->anyosDisponibles=Cuenta::getDb()->createCommand( 'SELECT dameTablasAnyos()' )->queryScalar();    
           return $this->render('index',['model'=>$modelo,'guardadook'=>'0','any'=>$anyo,'restore'=>'2',
            ]);
       }else{
           Cuenta::getDb()->createCommand( 'call recuperarCuenta('.$anyo.',@otro)' )->execute();
           $exito = Cuenta::getDb()->createCommand( 'SELECT @otro')->queryScalar();
           $modelo->anyoActual = Cuenta::getDb()->createCommand( 'SELECT contActual()' )->queryScalar();
           $modelo->anyosDisponibles=Cuenta::getDb()->createCommand( 'SELECT dameTablasAnyos()' )->queryScalar();
           if($exito==0){
               return $this->render('index',['model'=>$modelo,'guardadook'=>'0','any'=>$anyo,'restore'=>'2'
            ]);
           }else{
               return $this->render('index',['model'=>$modelo,'guardadook'=>'0','any'=>$anyo,'restore'=>'1'
            ]);
           }
           
               
           
       }
       return $this->redirect("index.php?r=cambioanyo");
    }
    
    /**
     * Función que reinicia la contabilidad y la deja a 0
     */
    public function actionReiniciar(){
        Cuenta::getDb()->createCommand( 'call reiniciarCuenta();' )->execute();
        return $this->redirect('index.php?r=cuenta/index');
    }
    
    
    /**
     * Guarda la tabla actual Cuentas como cuentaXXXX siendo XXXX el año elegido
     * 
     */
    public function actionGuardar(){
        $modelo = new CambioAnyo();
        
        
        $anyo = NULL;
        if(Yii::$app->request->post('guardarcomo')!=NULL){
            $modelo->anyosave=Yii::$app->request->post('guardarcomo');
            $anyo=$modelo->anyosave;
        }                
          
        if($anyo==NULL){
            $modelo->anyoActual = Cuenta::getDb()->createCommand( 'SELECT contActual()' )->queryScalar();
            $modelo->anyosDisponibles=Cuenta::getDb()->createCommand( 'SELECT dameTablasAnyos()' )->queryScalar();    
            return $this->render('index',['model'=>$modelo,'guardadook'=>'2','restore'=>'0',
            ]);
        }else{
           Cuenta::getDb()->createCommand( 'call copiarCuentaComo('.$anyo.')' )->execute();
           $modelo->anyoActual = Cuenta::getDb()->createCommand( 'SELECT contActual()' )->queryScalar();
           $modelo->anyosDisponibles=Cuenta::getDb()->createCommand( 'SELECT dameTablasAnyos()' )->queryScalar();    
           return $this->render('index',['model'=>$modelo,'guardadook'=>'1','any'=>$anyo,'restore'=>'0',
            ]); 
        }
        
    }
    
    /**
     * Elimina la contabilidad guardada
     */
    public function actionDelete(){
        $anyo= Yii::$app->request->post('anyocont');
        $consulta = 'DROP TABLE IF EXISTS cuenta'.$anyo.';';
        Cuenta::getDb()->createCommand($consulta)->execute();
        return $this->redirect("index.php?r=cambioanyo");
    }
    
    
    /**
     * Finds the Codigos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Codigos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Codigos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function comprobarPermiso(){
        if(Roles::getInvitado() || !Roles::getContabilidad()){
            
            return $this->redirect("index.php?r=site/nologed&pg=codigos");
        }
        return true;
    }
}
