<?php

namespace app\models;


class Nologed 
{
    //Sobreescribimos este método si el nombre de la tabla no
    //corresponde con el de la clase, sinó lo coge de la clase
    public $Titulo="Usuario sin permiso";
    public $Mensaje="No tiene permisos para acceder a esta parte de la aplicación";
    public $Duracion=10;
    
    public function getTitulo(){
        return $this->Titulo;
    }
    public function getMensaje(){
        return $this->Mensaje;
    }
    public function getTiempo(){
        return $this->Duracion;
    }
    
    public function setTitulo($Titulo="Usuario sin permiso"){
        $this->Titulo = $Titulo;
    }
    public function setMensaje($Mensaje = "No tiene permisos para acceder a esta parte de la aplicación"){
        $this->Mensaje = $Mensaje;
    }
    public function setTiempo($Duracion=10){
        $this->Duracion = $Duracion;
    }
    
}