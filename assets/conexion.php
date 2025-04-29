<?php

$server = "localhost:3308";
$user = "root";
$pass = "";
$gym = "gym";

$conexion = new mysqli($server, $user, $pass, $gym);

if($conexion -> connect_errno){
    die("Conexion Fallida" . $conexion->connect_errno);
} else {
    echo "conectado";
}


?>