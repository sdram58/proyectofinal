<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "codigos".
 *
 * @property integer $id
 * @property integer $identificador
 * @property string $descripcionc
 * @property string $descripcionv
 *
 * @property Subcodigos[] $subcodigos
 */
class Codigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'codigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identificador'], 'required'],
            [['identificador'], 'integer'],
            [['descripcionc', 'descripcionv'], 'string', 'max' => 60],
            [['identificador'], 'unique']
        ];
    }
    
    public static function getDb(){
        return \Yii::$app->dbconta;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identificador' => 'Identificador',
            'descripcionc' => 'Descripción Castellano',
            'descripcionv' => 'Descripció Valencià',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcodigos()
    {
        return $this->hasMany(Subcodigos::className(), ['codigo' => 'identificador']);
    }
}
