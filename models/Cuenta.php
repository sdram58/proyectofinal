<?php

namespace app\models;

use Yii;
use app\models\Codigos;
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
 *
 * @property Subcodigos $idconcepto0
 */
class Cuenta extends \yii\db\ActiveRecord
{
    
    public static $cuentas =['0'=>'A', '1'=>'B'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'saldo', 'idconcepto', 'fecha'], 'required'],
            [['id', 'tipocuenta', 'idconcepto'], 'integer'],
            [['saldo'], 'number'],
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
        $subcodigo = new Subcodigos();
        $subcodigos = $subcodigo->find();
        $conceptos = [];
        foreach($subcodigo as $key=>$valor){
            $conceptos[$key] = $valor['codigo'].$valor['identificador'].'.-'.$valor['Descripcionc'];
        }   
        return $conceptos;
            
    }
}
