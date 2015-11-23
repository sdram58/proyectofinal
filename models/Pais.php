<?php

namespace app\models;

use yii\db\ActiveRecord;

class Pais extends ActiveRecord
{
    //Sobreescribimos este método si el nombre de la tabla no
    //corresponde con el de la clase, sinó lo coge de la clase
    public static function tableName()
    {
        return 'pais';
    }
}