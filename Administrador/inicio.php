<?php
session_start();

echo "hola";

$mail = $_SESSION['correo_usuario'];

echo $mail;


?>