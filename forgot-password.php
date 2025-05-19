<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$host = 'localhost:3308';
$basedatos = 'gym';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dns = "mysql:host=$host;dbname=$basedatos;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dns, $user, $password, $options);
} catch (\PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'] ?? '';

    if( empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Por favor proprociona un correo valido";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo_usuario = ?");
        $stmt->execute([$correo]);
        $result = $stmt->fetch();

        if($result) {
            $token = bin2hex(random_bytes(32));

            $stmt = $pdo->prepare("UPDATE usuarios SET token_password = ? WHERE correo_usuario = ?");
            $stmt->execute([$token, $result['correo_usuario']]);

            $enlace = "http://localhost/gym/restablecer_contraseña.php?token=$token";

            $mail = new PHPMailer(true);

            try {
                //configuracion del server SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gcrossfit4@gmail.com';
                $mail->Password = 'ktvtmhntovsgpbpx'; // Contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configuración del correo
                $mail->setFrom('gcrossfit4@gmail.com', 'Sistema de Recuperacion');
                $mail->addAddress($correo);
                $mail->isHTML(true);
                $mail->Subject = 'Recuperacion de contrasena';
                $mail->Body = "
                    <h1>Recuperar contraseña</h1>
                    <p>Hola, para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
                    <a href='$enlace'>Restablecer contraseña</a>
                    <p>Si no solicitaste este cambio, ignora este correo.</p>
                ";

                // Enviar el correo
                $mail->send();
                $mensaje = "Correo enviado con éxito. Revisa tu bandeja de entrada.";
            } catch (Exception $e){
                $mensaje = "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        } else {
            $mensaje = "Correo no registrado";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - GYM</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <a href="index.html" class="logo">
                </a>
                <h1>RECUPERA TU <span>CONTRASEÑA</span></h1>
                <p>Ingresa tu correo electrónico para recibir instrucciones</p>
            </div>
            
            <form class="login-form" id="forgotPasswordForm" method='post' action='forgot-password.php'>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name='email' placeholder="tu@email.com" required>
                    </div>
                </div>
                <?php if (!empty($mensaje)): ?>
                    <div class="message">
                        <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="recovery-info">
                    <i class="fas fa-info-circle"></i>
                    <p>Te enviaremos un enlace a tu correo electrónico para restablecer tu contraseña. Asegúrate de revisar tu bandeja de entrada y carpeta de spam.</p>
                </div>
                
                <button type="submit" class="login-button">ENVIAR INSTRUCCIONES</button>
            </form>
            
            <div class="recovery-steps">
                <h3>Proceso de recuperación</h3>
                <ol>
                    <li>Ingresa tu correo electrónico registrado</li>
                    <li>Revisa tu bandeja de entrada</li>
                    <li>Haz clic en el enlace de recuperación</li>
                    <li>Crea una nueva contraseña</li>
                </ol>
            </div>
            
            <div class="register-link">
                <a href="Login.php"><i class="fas fa-arrow-left"></i> Volver al inicio de sesión</a>
            </div>
        </div>
        
        <div class="login-image">
            <div class="overlay">
                <div class="image-content">
                    <h2>SHAPE YOUR BODY</h2>
                    <h3>BE <span>STRONG</span></h3>
                    <h3>TRAINING HARD</h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
