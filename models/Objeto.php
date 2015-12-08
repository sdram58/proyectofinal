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
    public static function tableName()
    {
        return 'objeto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'ubicacion', 'categoria', 'tipo', 'fecha_alta'], 'required'],
            [['id', 'estado'], 'integer'],
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
            'ubicacion' => 'Ubicacion',
            'categoria' => 'Categoria',
            'tipo' => 'Tipo',
            'Descripcion' => 'Descripcion',
            'fecha_alta' => 'Fecha Alta',
            'fecha_baja' => 'Fecha Baja',
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
