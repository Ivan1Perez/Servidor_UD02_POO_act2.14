<?php

function crear_directorio($dir) {
    if(!is_dir($dir)) mkdir($dir);
}

function limpiar($txt) {
    return trim(htmlspecialchars($txt));
}

function lista($nombre, $opciones) {
    $str = "<select name=$nombre>";
    foreach ($opciones as $value) {
        if(!empty($value)) $str .= "<option value='$value'>$value</option>";
    }
    return $str;
}

function estado_archivo($nombre, $directorio, $imagen) {
    $parts = explode('.', $nombre);
    $nParts = count($parts);
    $extension = $parts[$nParts-1];
    if((strtoupper($extension)=='GIF') || (strtoupper($extension)=='PNG') || (strtoupper($extension)=='JPG')){
        $nombre = implode('.', $parts);
        $nombreCompleto = $imagen->cambiar_nombre($directorio, $nombre, $extension);
        return $nombreCompleto;
    }else return false;
}