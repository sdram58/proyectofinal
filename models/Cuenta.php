<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objeto".
 *
 * @property integer $id
 * @property integer $tipocuenta
 * @property double $saldo
 * @property integer $idconcepto
 * @property string $fecha
 */
class Cuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $TIPO_CUENTA =['0'=>'A', '1'=>'B'];
    
    public static function tableName()
    {
        return 'cuenta';
    }
    
   /* public static function getDb() {
        return Yii:;
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','tipocuenta', 'saldo', 'idconcepto', 'fecha'], 'required', 'message'=>'El campo \'{attribute}\' no puede estar en blanco'],
            [['tipocuenta'], 'integer'],
            [['saldo'], 'double'],
            [['fecha'], 'safe'],                        
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
            'saldo' => 'Saldo',
            'idconcepto' => 'Concepto',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConcepto0()
    {
        return $this->hasOne(CategoriasObjetos::className(), ['id' => 'idconcepto']);
    }
    
    
}
