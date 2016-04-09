<?php

/* 
 * Modelo virtual para cambiar el el año de la contabilidad
 * Creado por Carlos Tarazona
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CambioAnyo extends Model
{
    public $anyorestore;
    public $anyosave;
    public $anyoActual;
    public $anyosDisponibles;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['anyosave'], 'required'],
            [['anyogrestore','anyosave'],'number'],
            ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'anyorestore' => 'Elegir año',
            'anyosave'=>'Guardar como',
        ];
    }


}
