<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Nologed;
use app\models\ContactForm;
use app\models\TipoCategorias;
use app\models\CategoriasObjetos;
use app\models\Ubicaciones;
use app\models\Usuario;
use app\models\Objeto;
use app\models\Cuenta;
/*Use de pruebas*/
use app\models\IngresoFormulario;




class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLogin()
    {
        $model = new LoginForm();
        /*if (!Yii::$app->user->isGuest) {
            $session = Yii::$app->session;            
            $session->open();  

            $session['contabilidad'] = $model->getUser()->contabilidad;
            
            return $this->goHome();
        }*/
        
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack(); ?>           
        <?php }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionDecir($mensaje = 'Hola Mundo')
    {
        return $this->render('decir',['mensaje'=>$mensaje]);
    }
    
    /****Ejemplo Formulario **********************************************************/
    public function actionIngreso()
    {
     $model = new IngresoFormulario;

     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      // Valida los datos recibidos en $model

      // Se puede manipular los datos de $model

      return $this->render('confirmar-ingreso', ['model' => $model]);
     } else {
      // Se despliega la pagina inicial o si hay un error de validacion
      return $this->render('ingreso', ['model' => $model]);
     }    
    }
    
    public function actionAjax(){
         if (isset($_POST['categoria'])){
            $categoria = $_POST['categoria'];
            $tc = new TipoCategorias();
            echo json_encode($tc->getTipoCategoriasByCategoria($categoria));
        }
        if (isset($_POST['dameusu'])){
            $damecat = $_POST['dameusu'];
            if($damecat){
                $tc = new Usuario();
                echo json_encode($tc->getUsuarios());
            }
            
        }
        if (isset($_POST['damecat'])){
            $damecat = $_POST['damecat'];
            if($damecat){
                $tc = new CategoriasObjetos();
                echo json_encode($tc->getCategorias());
            }
            
        }
        if (isset($_POST['dameubi'])){
            $damecat = $_POST['dameubi'];
            if($damecat){
                $tc = new Ubicaciones();
                echo json_encode($tc->getUbicaciones());
            }
            
        }
        if (isset($_POST['damesubc'])){
            $damecat = $_POST['damesubc'];
            if($damecat){
                $tc = new TipoCategorias();
                echo json_encode($tc->getAllTipoCategorias());
            }
            
        }
        if (isset($_POST['damecg'])){
            $damecat = $_POST['damecg'];
            if($damecat){
                $tc = new Cuenta();
                echo json_encode($tc->getConceptosGastos());
            }
            
        }
        if (isset($_POST['dameci'])){
            $damecat = $_POST['dameci'];
            if($damecat){
                $tc = new Cuenta();
                echo json_encode($tc->getConceptoIngresos());
            }
            
        }
        
        if (isset($_POST['duplicar'])){//Llama al procedimiento 
            $dup = $_POST['duplicar'];
            if($dup){
                if (isset($_POST['id']) && isset($_POST['cantidad'])){
                    $id = $_POST['id'];
                    $cantidad = $_POST['cantidad'];
                    $model = new Objeto();
                    try{
                        $numRowsAffected = $model::getDb()->createCommand("call duplicarObjeto(".$id.",".$cantidad.");")->execute();
                        $objeto = Objeto::findOne($id);
                        echo "Se han añadido ".$cantidad." registros más del objeto ".$objeto->tipo." de ".$objeto->ubicacion;
                    }catch(yii\db\Exception $e){
                        echo "No se ha podido duplicar según su solicitud";
                    }
                    
                }
            }
            
        }
     }
     
     public function actionNologed(){
        $model = new Nologed;
        $pagina = isset($_GET['pg'])?$_GET['pg']:'';
        
        $titulo='';
        $mensaje='';
        switch($pagina){
            case 'usuario':
                $titulo = 'Acceso a gestión de usuarios no permitido';
                $mensaje = 'No tiene acceso a la sección de Usuarios, pruebe a acceder con un usuario válido';
                break;
            case 'categorias':
                $titulo = 'Acceso a Categorias no permitido';
                $mensaje = 'No tiene acceso a la sección de Categorias, pruebe a acceder con un usuario válido';
                break;
            case 'tcategorias':
                $titulo = 'Acceso a Subcategorias no permitido';
                $mensaje = 'No tiene acceso a la sección de Subcategorias, pruebe a acceder con un usuario válido';
                break;
            case 'contabilidad':
                $titulo = 'Acceso a Movimientos no permitido';
                $mensaje = 'No tiene acceso a la sección de Contabilidad, pruebe a acceder con un usuario válido';
                break;
            case 'inventario':
                $titulo = 'Acceso al inventario no permitido';
                $mensaje = 'No tiene acceso a la sección de Inventario, pruebe a acceder con un usuario válido';
                break;
            case 'ubicaciones':
                $titulo = 'Acceso a las Ubicaciones no permitido';
                $mensaje = 'No tiene acceso a la sección de Ubicaciones, pruebe a acceder con un usuario válido';
                break;
            case 'codigos':
                $titulo = 'Acceso a los Códigos de contabilidad no permitido';
                $mensaje = 'No tiene acceso a la sección de códigos, pruebe a acceder con un usuario válido';
                break;
            case 'subcodigo':
                $titulo = 'Acceso a los Subcodigos de contabilidad no permitido';
                $mensaje = 'No tiene acceso a la sección de subcodigos, pruebe a acceder con un usuario válido';
                break;
            default:
                $titulo = 'Acceso no permitido';
                $mensaje = 'No tiene acceso a la sección, pruebe a acceder con un usuario válido';
                break;
        }        
        
        $model->setTitulo($titulo);
        $model->setMensaje($mensaje);
        return $this->render('nologed', ['model' => $model]);        
    }
}
