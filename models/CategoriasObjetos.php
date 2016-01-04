<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias_objetos".
 *
 * @property string $id
 * @property string $categoria
 *
 * @property Objeto[] $objetos
 * @property TipoCategorias[] $tipoCategorias
 */
class CategoriasObjetos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorias_objetos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria'], 'required'],
            [['id'], 'string', 'max' => 20],
            [['categoria'], 'string', 'max' => 50],
            [['categoria'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador interno',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objeto::className(), ['categoria' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCategorias()
    {
        return $this->hasMany(TipoCategorias::className(), ['categoria' => 'id']);
    }
    
    public function getCategorias(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM categorias_objetos")->queryAll();
        $categorias = array();
        $i=0;
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        return $categorias;
    }
    
}
