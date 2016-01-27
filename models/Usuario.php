<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $inventario
 * @property integer $contabilidad
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $permisos =['0'=>'NO', '1'=>'SI'];
    
    public static function tableName()
    {
        return 'usuario';
    }
    
    
    /*
     * Selecciona la Base de datos user
     * 
     */
    
    public static function getDb(){
        return \Yii::$app->dbuser;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required','message' => 'El campo {attribute} es obligatorio'],
            [['inventario', 'contabilidad','usuario'], 'integer', 'when' => function($model) {
                return ($model->usuario<=2 && $model->usuario>=1 && $model->inventario<=2 && $model->inventario>=1 && $model->contabilidad<=2 && $model->contabilidad>=1);
            }],
            [['username', 'password'], 'string', 'max' => 20],
            [['username'], 'unique'],
            ['username', 'validacionUsername','skipOnEmpty' => false,'skipOnError' => false],
        ];
    }

    public function validacionUsername($attribute, $params){
        if(strrpos($_SERVER['REQUEST_URI'],"update")>-1){
                $usuarios = $this->getUsuariosMenosActual($this->$attribute);
        }else{
            $usuarios = $this->getUsuarios();
        }

        foreach($usuarios as $id=>$valor){
            if($usuarios[$id]==strtoupper($this->$attribute)){
                return $this->addError($attribute,'El usuario \''.$this->$attribute.'\' ya existe.');
            }
        }       
      
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'inventario' => 'Inventario',
            'contabilidad' => 'Contabilidad',
            'usuario' => 'Usuario',
        ];
    }
    
    
    public function getUsuarios(){
        $temp = Yii::$app->getDb()->createCommand("SELECT * FROM usuario")->queryAll();
        $usuario = array();
        foreach($temp as $usr){                          
            $usuario[$usr['id']] = strtoupper($usr['username']);  
        }
        return $usuario;
    }
    public function getUsuariosMenosActual($usr){
        $comando = Yii::$app->getDb()->createCommand("SELECT * FROM usuario WHERE UPPER(username) NOT LIKE :usr ");
        
        $temp = $comando->bindValue(':usr', strtoupper($usr))->queryAll();
        
        $usuario = array();
        foreach($temp as $usr){                          
            $usuario[$usr['id']] = strtoupper($usr['username']);  
        }
        return $usuario;
    }
}
