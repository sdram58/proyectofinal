<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $usuario
 * @property string $pass
 * @property integer $inventario
 * @property integer $contabilidad
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['usuario', 'pass'], 'required'],
            [['inventario', 'contabilidad'], 'integer'],
            [['usuario', 'pass'], 'string', 'max' => 20],
            [['usuario'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'pass' => 'Pass',
            'inventario' => 'Inventario',
            'contabilidad' => 'Contabilidad',
        ];
    }
}
