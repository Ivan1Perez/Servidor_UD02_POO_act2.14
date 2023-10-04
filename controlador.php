<?php
require "funciones.php";
require "imagen.php";
require "vistas/inicio.html";

if(isset($_POST['submitOptions'])){
    $ops[0] = limpiar($_POST['directorio1']);
    $ops[1] = limpiar($_POST['directorio2']);
    $ops[2] = limpiar($_POST['directorio3']);
    $ops[3] = limpiar($_POST['directorio4']);
    require "vistas/formulario.php";
}elseif (isset($_POST['enviarFichero'])) {
    $nombre = $_FILES['fichero']['name'];
    $imagen = new Imagen($_FILES['fichero']['tmp_name'], "", "");
    if($imagen->esta_cargado()){
        $dir = $_POST['directorio'];
        crear_directorio($dir);
        if($nombre=estado_archivo($nombre, $dir, $imagen)){
            $imagen->mover($nombre);
            $mensaje = "El fichero $nombre se ha subido correctamente.";
        }else $mensaje="El archivo no es de extensión correcta";
    }else{
        $mensaje= "No se ha podido subir el fichero";
    }
    $mensaje.="<a href='controlador.php'> Volver a inicio </a>";
	require "vistas/mensaje.php";
}else{
    require "vistas/opciones.html";
}

require "vistas/fin.html";

