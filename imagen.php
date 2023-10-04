<?php
/*
Actividad 2.14. Subir archivos con POO.
Modificaremos las actividade 2.10 para incluir objetos:
Crearemos un archivo separado que definirá una clase llamada Imagen que se utilizara para 
ubicar propiedades y métodos del array asociativo $_FILES 
Tendrá las propiedades o atributos 'tmp_name', 'name', y 'type' y 
los métodos :
"esta_cargado()" que devolverá true si existe el archivo temporal.
cambiar_nombre()" que actualizara la propiedad 'name' a la propiedad con el 
nombre completo (directorio e id --> si hace falta)
 "mover()" que copiara definitivamente el archivo temporal a su directorio definitivo 
con su nombre definitivo.
Este fichero constituirá el modelo y se incluirá con un require al principio del controlador y 
modificaremos toda la programación para utilizar un objeto de esta clase.
*/

class Imagen{
    private $tmp_name;
    private $name;
    private $type;

    function __construct($tmp_name, $name, $type) {
        $this->tmp_name = $tmp_name;
        $this->name = $name;
        $this->type = $type;
    }

    public function __set($var, $valor){ 
        if (property_exists(__CLASS__, $var)){
        $this->$var = $valor; 
         } else 
        echo "No existe el atributo $var."; 
    } 

    function esta_cargado() {
        if(is_uploaded_file($_FILES['fichero']['tmp_name'])){
            return true;
        }else {
            return false;
        }
    }

    function cambiar_nombre($directorio, $nombre, $extension) {
        if(is_file($directorio.'/'.$nombre)){
            $nombreCambiado = $directorio."/".uniqid()."_".$nombre;
        }else{
            $nombreCambiado = $directorio."/".$nombre;
            $this->name = $nombre;
            $this->type = $extension;
        }
        return $nombreCambiado;
    }

    function mover($nombre) {
        move_uploaded_file($this->tmp_name, $nombre);
    }
}
