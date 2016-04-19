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
    
    public static function getDb(){
        return \Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria'], 'required'],
            ['id', 'validacionId','skipOnEmpty' => false,'skipOnError' => false],
            ['categoria', 'validacionId','skipOnEmpty' => false,'skipOnError' => false],
            [['id'], 'string', 'max' => 20],
            [['categoria'], 'string', 'max' => 50],
            [['categoria'], 'unique'],            
        ];
    }
    /**
     * Valida los campos id y categoria, si ya existe alguno.
     * @param type $attribute
     * @param type $params
     * @return type
     */
    public function validacionId($attribute, $params){
        if(strrpos($_SERVER['REQUEST_URI'],"update")>-1){
            if($attribute=='id'){
                $categorias = $this->getCategorias();
                unset($categorias[$this->$attribute]);
            }else{
                $categorias = $this->getCategoriasMenosUna($this->$attribute);
            }
        }else{
            $categorias = $this->getCategorias();
        }
        if($attribute=='id'){
            foreach($categorias as $id=>$valor){
                if($id==strtoupper($this->$attribute)){
                    return $this->addError($attribute,'El identificador \''.$this->$attribute.'\' ya existe.');
                }
            }
        }else{
            if($attribute=='categoria'){
            foreach($categorias as $id=>$valor){
                if($valor==strtoupper($this->$attribute)){
                    return $this->addError($attribute,'La categoría \''.$this->$attribute.'\' ya existe.');
                }
            }
        }
        }        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id interno',
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
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM categorias_objetos ORDER BY id")->queryAll();
        $categorias = array();
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        return $categorias;
    }
    public function getCategoriasMenosUna($categoria){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM categorias_objetos WHERE UPPER(categoria) NOT LIKE :cat ");
        
        $temp = $comando->bindValue(':cat', strtoupper($categoria))->queryAll();
        
        $categorias = array();
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        return $categorias;
    }
    
    
    /**
     * noTieneObjetos comprueba que no existen objetos de esta categoria
     */
    public function noTieneObjetos($id){
        $notiene=false;
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM objeto WHERE UPPER(categoria) LIKE :cat ");
        
        $temp = $comando->bindValue(':cat', strtoupper($id))->queryAll();
        if(count($temp)>0){
            return false;
         } else {
            return true;
        }
        
    }
    
    /**
     * noTieneCategorias comprueba que no existen tipo de categoria de esta categoria
     */
    public function noTieneCategorias($id){
        $notiene=false;
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM tipo_categorias WHERE UPPER(categoria) LIKE :cat ");
        
        $temp = $comando->bindValue(':cat', strtoupper($id))->queryAll();
        $categorias = array();
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        if(count($temp)>0){
            return false;
         } else {
            return true;
        }
        
    }
}
