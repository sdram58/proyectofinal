<?php

namespace app\models;

use yii\base\Model;

class IngresoFormulario extends Model
{
    public $nombre;
    public $correo;

    public function rules()
    {
        return [
            [['nombre', 'correo'], 'required'],
            ['correo', 'email'],
        ];
    }
}

?> 