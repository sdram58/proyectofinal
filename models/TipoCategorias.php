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
            [['tipo'], 'unique'],
            ['tipo', 'validacionTipo','skipOnEmpty' => false,'skipOnError' => false],
        ];
    }
    
    /**
     * Comprueba si el tipo ya existe.
     * @param type $attribute
     * @param type $params
     * @return type
     */
    public function validacionTipo($attribute, $params){
        if(strrpos($_SERVER['REQUEST_URI'],"update")>-1){           
            $subcategorias = $this->getAllTipoCategoriasMenosUno($this->$attribute);
        }else{
            $subcategorias = $this->getAllTipoCategorias();
        }
        foreach($subcategorias as $id=>$valor){
            if($id==strtoupper($this->$attribute)){
                return $this->addError($attribute,'El tipo \''.$this->$attribute.'\' ya existe.');
            }
        }     
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [            
            'tipo' => 'Subcategoría',
            'categoria' => 'Categoría',
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
    
    public function getAllTipoCategorias(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM tipo_categorias")->queryAll();
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
    public function getAllTipoCategoriasMenosUno($tipo){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM tipo_categorias WHERE UPPER(tipo) NOT LIKE :tipo ");
        
        $temp = $comando->bindValue(':tipo', strtoupper($tipo))->queryAll();
        
        $tiposCategorias = array();
        foreach($temp as $tc){                          
            $tiposCategorias[$tc['tipo']] = strtoupper($tc['tipo']);  
        }
        return $tiposCategorias;
    }
    
    public function getMiCategoria(){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM categorias_objetos WHERE UPPER(id) LIKE :cat ");
        
        $temp = $comando->bindValue(':cat', strtoupper($this->categoria))->queryAll();
        
        $categorias = array();
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        return $categorias;
        
    }
    public function getCategorias(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM categorias_objetos")->queryAll();
                
        $categorias = array();
        foreach($temp as $cat){                          
            $categorias[$cat['id']] = strtoupper($cat['categoria']);  
        }
        return $categorias;
        
    }
    
}
