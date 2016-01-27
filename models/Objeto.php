<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objeto".
 *
 * @property integer $id
 * @property integer $estado
 * @property string $ubicacion
 * @property string $categoria
 * @property string $tipo
 * @property string $Descripcion
 * @property string $fecha_alta
 * @property string $fecha_baja
 *
 * @property CategoriasObjetos $categoria0
 * @property TipoCategorias $tipo0
 * @property Ubicaciones $ubicacion0
 */
class Objeto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $estados =['1'=>'ALTA', '2'=>'BAJA'];
    
    public static function tableName()
    {
        return 'objeto';
    }
    
    public static function getDb(){
        return \Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'ubicacion', 'categoria', 'tipo', 'fecha_alta'], 'required', 'message'=>'El campo \'{attribute}\' no puede estar en blanco'],
            [['estado'], 'integer'],
            [['fecha_alta', 'fecha_baja'], 'safe'],
            [['ubicacion'], 'string', 'max' => 50],
            [['categoria', 'tipo'], 'string', 'max' => 20],
            [['Descripcion'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
            'ubicacion' => 'Ubicación',
            'categoria' => 'Categoría',
            'tipo' => 'Tipo',
            'Descripcion' => 'Descripción (N/S)',
            'fecha_alta' => 'Fecha de Alta',
            'fecha_baja' => 'Fecha de Baja',
        ];
    }
    
    /**
     * Retorna todos los atributos con sus tipos correspondientes
     * @return array() de tipos
     */
    public function getTipos(){
        return [
            'ID'=>'number', 
            'Estado'=>'number',
            'Fecha de Alta'=>'date',
            'Fecha de Baja'=>'date',
            'Categoría'=>'number',
            'Ubicación'=>'text',
            'Tipo'=>'number',
            'Descripción (N/S)' => 'text',
            
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(CategoriasObjetos::className(), ['id' => 'categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoCategorias::className(), ['tipo' => 'tipo']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacion0()
    {
        return $this->hasOne(Ubicaciones::className(), ['id' => 'ubicacion']);
    }
}
