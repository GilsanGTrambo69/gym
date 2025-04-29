<?php
session_start();
include 'assets/conexion.php';


$nombre = $_POST['firstName'];
$apellido = $_POST['lastName'];
$correo = $_POST['email'];
$telefono = $_POST['phone'];
$password1 = $_POST['password'];



echo $nombre, $apellido, $correo, $telefono;

//validacion de correo
if(!preg_match('/@gmail\.com$/', $correo)) {
    $_SESSION['email_error'] = "Solo se permite registrar con correos @gmail.com";
    header('Location: register.php');
    exit();
}

//validar si el correo ya existe en la base de datos
$email_prev = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo_usuario = '$correo'"));
if ($email_prev > 0) {
    $_SESSION['email_error'] = "Este correo ya se encuentra registrado";
    header("Location: register.php");
    exit();
}

$tel_prev = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM usuarios WHERE telefono_usuario = '$telefono'"));
if ($tel_prev > 0) {
    $_SESSION['tel_error'] = "Este numero de telefono ya se encuentra registrado";
    header("Location: register.php");
    exit();
} 

$contraseña = md5($password1);
$rol = 1;

$registro_query = "INSERT INTO usuarios (nombre_usuario, apellido_usuario, correo_usuario, telefono_usuario, contraseña, id_rol_usuario) 
VALUES('$nombre', '$apellido', '$correo', '$telefono', '$contraseña', '$rol')";
$exe_query = mysqli_query($conexion, $registro_query);

if ($exe_query){
    echo "usuario registrado";
} else {
    echo "error en el registro";
}

header('Location: login.php')


?>