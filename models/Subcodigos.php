<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcodigos".
 *
 * @property integer $id
 * @property integer $identificador
 * @property integer $codigo
 * @property string $descripcionv
 * @property string $descripcionc
 *
 * @property Cuenta[] $cuentas
 * @property Codigos $codigo0
 */
class Subcodigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcodigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identificador', 'codigo'], 'required'],
            [['identificador', 'codigo'], 'integer'],
            [['descripcionv', 'descripcionc'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identificador' => 'Identificador',
            'codigo' => 'Codigo',
            'descripcionv' => 'Descripcionv',
            'descripcionc' => 'Descripcionc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['idconcepto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigo0()
    {
        return $this->hasOne(Codigos::className(), ['identificador' => 'codigo']);
    }
}
