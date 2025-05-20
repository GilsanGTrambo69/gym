<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$conexion = mysqli_connect('localhost:3308', 'root', '', 'gym');

if (!$conexion){
    die("Error de conexion a la base de datos" . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");

if (!empty($_POST['doc']) && !empty($_POST['password'])){
    $documento = $_POST['doc'];
    $password = $_POST['password'];
    $contraseña = md5($password);

    $documento = mysqli_real_escape_string($conexion, $documento);
    $contraseña = mysqli_real_escape_string($conexion, $contraseña);

    $query = "SELECT * FROM usuarios WHERE documento_usuario = '$documento' AND contraseña = '$contraseña'";
    
    if($execute_query = mysqli_query($conexion, $query)) {
        if ($data = mysqli_fetch_assoc($execute_query)) {
            $doc_sesion = $data['documento_usuario'];
            $rol_sesion = $data['id_rol_usuario'];
            $_SESSION["documento_usuario"] = $doc_sesion;
            
            switch($rol_sesion) {
                case 1; header('Location: Usuario/inicio.php'); exit;
                case 2; header('Location: Administrador/usuarios.php'); exit;
                case 3; header('Location: Entrenador/inicio.php'); exit;
            }
        } else {
            echo '<div><font color="red">Correo o contraseña incorrectos. Inténtalo de nuevo.</font></div>';
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} 
?>