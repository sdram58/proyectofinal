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
            [['username'], 'unique']
        ];
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
}
