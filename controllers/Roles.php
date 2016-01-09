<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;

use Yii;

class Roles {
    
    public static function getContabilidad(){
        return Yii::$app->user->identity->contabilidad=='1';
    }
    
    public static function getInvitado(){
        return Yii::$app->user->isGuest;
    }
    
    public static function getInventario(){
        return Yii::$app->user->identity->inventario=='1';
    }
    public static function getUsuario(){
        return Yii::$app->user->identity->usuario=='1';
    }
           
}

