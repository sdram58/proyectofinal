<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_categorias".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $categoria
 *
 * @property Objeto[] $objetos
 * @property CategoriasObjetos $categoria0
 */
class TipoCategorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'categoria'], 'required'],
            [['tipo'], 'string', 'max' => 30],
            [['categoria'], 'string', 'max' => 20],
            [['tipo'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objeto::className(), ['tipo' => 'tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(CategoriasObjetos::className(), ['id' => 'categoria']);
    }
}
