<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicaciones".
 *
 * @property string $id
 * @property string $Descripcion
 *
 * @property Objeto[] $objetos
 */
class Ubicaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubicaciones';
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
            [['id', 'Descripcion'], 'required'],
            [['id'], 'string', 'max' => 50],            
            ['id', 'validacionId','skipOnEmpty' => false,'skipOnError' => false],
            ['Descripcion', 'validacionId','skipOnEmpty' => false,'skipOnError' => false],
            [['Descripcion'], 'string', 'max' => 75],
            [['Descripcion'], 'unique']
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
                $ubicaciones = $this->getUbicaciones();
                unset($ubicaciones[strtoupper($this->$attribute)]);
            }else{
                $ubicaciones = $this->getUbicacionesMenosUna($this->$attribute);
            }
        }else{
            $ubicaciones = $this->getUbicaciones();
        }
        if($attribute=='id'){
            foreach($ubicaciones as $id=>$valor){
                if(strtoupper($id)==strtoupper($this->$attribute)){
                    return $this->addError($attribute,'El identificador \''.$this->$attribute.'\' ya existe.');
                }
            }
        }else{
            if($attribute=='Descripcion'){
            foreach($ubicaciones as $id=>$valor){
                if(strtoupper($valor)==strtoupper($this->$attribute)){
                    return $this->addError($attribute,'La Descripción \''.$this->$attribute.'\' ya existe.');
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
            'id' => 'Identificador',
            'Descripcion' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objeto::className(), ['ubicacion' => 'id']);
    }
    
    public function getUbicaciones(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM ubicaciones")->queryAll();
        $ubicaciones = array();
        foreach($temp as $ubi){                          
            $ubicaciones[strtoupper($ubi['id'])] = strtoupper($ubi['Descripcion']);  
        }
        return $ubicaciones;
    }
        

    public function getUbicacionesMenosUna($descripcion){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM ubicaciones WHERE UPPER(Descripcion) NOT LIKE :ubi ");
        
        $temp = $comando->bindValue(':ubi', strtoupper($descripcion))->queryAll();
        
        $ubicaciones = array();
        foreach($temp as $ubi){                          
            $ubicaciones[strtoupper($ubi['id'])] = strtoupper($ubi['Descripcion']);  
        }
        return $ubicaciones;
    }
}
