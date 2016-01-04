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
    
    public function getTipoCategorias(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM tipo_categorias WHERE categoria like 'EDFISICA' ")->queryAll();
        $tiposCategorias = array();
        foreach($temp as $tc){                          
            $tiposCategorias[$tc['tipo']] = strtoupper($tc['tipo']);  
        }
        return $tiposCategorias;
    }
    
    public function getTipoCategoriasByCategoria($categoria){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM tipo_categorias WHERE UPPER(categoria) like :cat ");
        
        $temp = $comando->bindValue(':cat', strtoupper($categoria))->queryAll();
        
        
        $tiposCategorias = array();
        foreach($temp as $tc){                          
            $tiposCategorias[$tc['tipo']] = strtoupper($tc['tipo']);  
        }
        return $tiposCategorias;
    }
    
    }
