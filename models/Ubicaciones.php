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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Descripcion'], 'required'],
            [['id'], 'string', 'max' => 50],
            [['Descripcion'], 'string', 'max' => 75],
            [['Descripcion'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetos()
    {
        return $this->hasMany(Objeto::className(), ['ubicacion' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UbicacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UbicacionesQuery(get_called_class());
    }
}
