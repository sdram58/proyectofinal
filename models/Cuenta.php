<?php

namespace app\models;

use Yii;
use app\models\Subcodigos;

/**
 * This is the model class for table "cuenta".
 *
 * @property integer $id
 * @property integer $tipocuenta
 * @property double $saldo
 * @property integer $idconcepto
 * @property string $fecha
 * @property string $descripcion
 *@property string $gastoingreso
 * *@property double $saldoactual
 * @property Subcodigos $idconcepto0
 */
class Cuenta extends \yii\db\ActiveRecord
{
    
    public static $cuentas =['0'=>'A', '1'=>'B'];
    public static $GASTO_INGRESO=['0'=>'GASTO', '1'=>'INGRESO'];
    public static $GASTO=0;
    public static $INGRESO=1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta';
    }
    
    public static function getDb(){
        return \Yii::$app->dbconta;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saldo', 'idconcepto', 'fecha', 'gastoingreso'], 'required'],
            [['id', 'tipocuenta', 'idconcepto','gastoingreso'], 'integer'],
            ['saldoactual', 'default', 'value' => 0],
            [['saldo','saldoactual'], 'number','min'=>0],
            [['fecha'], 'safe'],
            [['descripcion'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipocuenta' => 'Cuenta',
            'saldo' => 'Importe',
            'idconcepto' => 'Concepto',
            'fecha' => 'Fecha',
            'descripcion' => 'Descripción',
            'gastoingreso' => 'Movimiento',
        ];
    }
    
    /**
     * Retorna todos los atributos con sus tipos correspondientes
     * @return array() de tipos
     */
    public function getTipos(){
        return [
            'ID'=>'number', 
            'Importe'=>'decimal',
            'Fecha'=>'date',
            'Concepto'=>$this->getConceptos(),
            'Cuenta'=>Cuenta::$cuentas,
            'Movimiento'=>Cuenta::$GASTO_INGRESO,
            'Descripción' => 'text',
            
            ];
    }
    
    function fields() {
        return[
            'id' => 'ID',
            'tipocuenta' => 'Cuenta',
            'saldo' => 'Importe',
            'idconcepto' => 'Concepto',
            'fecha' => 'Fecha',
            'descripcion' => 'Descripción',
            'totalA'=>'2342',
            'totalB'=>'1111',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdconcepto0()
    {
        return $this->hasOne(Subcodigos::className(), ['id' => 'idconcepto']);
    }
    
    /**
     * Devuelve todos los subconceptos en un array del tipo ['idsub'=>'identificador concepto.identificador subcodigo.Descripcion]
     */
    public function getConceptos(){ ;
        $subcodigos = Subcodigos::find()
                    ->asArray()
                    ->all();
        $conceptos = [];
        foreach($subcodigos as $valor){
            $conceptos[$valor['id']] = strtoupper($valor['codigo'].'.'.$valor['identificador'].'.-'.$valor['descripcionc']);
           } 
        return $conceptos;
            
    }
    
    public function getConceptosGastos(){ 
        $subcodigos = Subcodigos::find()->where(['gastosingresos'=>cuenta::$GASTO])
                    ->asArray()
                    ->all();
        $conceptos = [];
        foreach($subcodigos as $valor){
            $conceptos[$valor['id']] = strtoupper($valor['codigo'].'.'.$valor['identificador'].'.-'.$valor['descripcionc']);
           } 
        return $conceptos;
            
    }
    
    public function getConceptoIngresos(){
        $subcodigos = Subcodigos::find()->where(['gastosingresos'=>cuenta::$INGRESO])
                    ->asArray()
                    ->all();
        $conceptos = [];
        foreach($subcodigos as $valor){
            $conceptos[$valor['id']] = strtoupper($valor['codigo'].'.'.$valor['identificador'].'.-'.$valor['descripcionc']);
           } 
        return $conceptos;
    }
    
    /**
     * Devuelvo el saldo total de todas las cuentas A
     */
    public function getSaldoA(){
        $command = $this::getDb()->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=0 AND gastoingreso=".cuenta::$INGRESO);
        $ingresos = $command->queryScalar();
        $command = $this::getDb()->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=0 AND gastoingreso=".cuenta::$GASTO);
        $gastos = $command->queryScalar();
        return ($ingresos - $gastos);
    }
    /**
     * Devuelvo el saldo total de todas las cuentas B
     */
    public function getSaldoB(){        
        $command = $this::getDb()->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=1 AND gastoingreso=".cuenta::$INGRESO);
        $ingresos = $command->queryScalar();
        $command = $this::getDb()->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=1 AND gastoingreso=".cuenta::$GASTO);
        $gastos = $command->queryScalar();
        return ($ingresos - $gastos);
    }
    
    public function getIngresosB(){        
        return  $this::getDb()
                ->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=1 AND gastoingreso=".cuenta::$INGRESO)
                ->queryScalar();
    }
    public function getIngresosA(){        
        return  $this::getDb()
                ->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=0 AND gastoingreso=".cuenta::$INGRESO)
                ->queryScalar();
    }
    public function getGastosB(){        
        return  $this::getDb()
                ->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=1 AND gastoingreso=".cuenta::$GASTO)
                ->queryScalar();
    }
    public function getGastosA(){        
        return  $this::getDb()
                ->createCommand("SELECT sum(saldo) FROM cuenta where tipocuenta=0 AND gastoingreso=".cuenta::$GASTO)
                ->queryScalar();
    }
    
    
    public function getListado($consulta){
       $miConsulta = "SELECT c.id, tipocuenta,saldoactual, saldo, idconcepto, fecha, descripcion, gastoingreso, codigo, identificador, descripcionc, descripcionv FROM cuenta c, subcodigos sc WHERE c.idconcepto=sc.id AND ";
       $miConsulta .= $consulta;        
       $temp = $this::getDb()->createCommand($miConsulta)->queryAll();        
        return $temp;
    }
}
