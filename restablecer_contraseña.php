<?php
$host = 'localhost:3308';
$db   = 'gym';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['password'];

    $password = md5($new_password);

    $stmt = $pdo->prepare("UPDATE usuarios SET contraseña = ?, token_password = NULL WHERE token_password = ?");
    $stmt->execute([$password, $token]);
    header('Location: Login.php');

} else {
    $token = $_GET['token'] ?? '';

    $stmt = $pdo->prepare("SELECT correo_usuario FROM usuarios WHERE token_password = ?");
    $stmt->execute([$token]);
    $result = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - GYM</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos adicionales específicos para la página de reset */
        .password-requirements {
            margin-top: 15px;
            padding: 15px;
            background-color: var(--input-bg);
            border-radius: 5px;
            font-size: 13px;
        }
        
        .password-requirements h4 {
            margin-bottom: 10px;
            color: var(--light-text);
            font-size: 14px;
        }
        
        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: var(--gray-text);
        }
        
        .requirement-item i {
            margin-right: 8px;
            font-size: 12px;
        }
        
        .requirement-item.valid {
            color: var(--success-color);
        }
        
        .requirement-item.valid i {
            color: var(--success-color);
        }
        
        .passwords-match {
            margin-top: 10px;
            font-size: 13px;
            color: var(--gray-text);
            display: flex;
            align-items: center;
        }
        
        .passwords-match i {
            margin-right: 8px;
        }
        
        .passwords-match.valid {
            color: var(--success-color);
        }
        
        .passwords-match.invalid {
            color: var(--danger-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <a href="index.html" class="logo">
                </a>
                <h1>RESTABLECE TU <span>CONTRASEÑA</span></h1>
                <p>Crea una nueva contraseña segura para tu cuenta</p>
            </div>
            
            <form class="login-form" id="resetPasswordForm" method="post" action="restablecer_contraseña.php">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu nueva contraseña" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                
                <div class="password-strength">
                    <div class="strength-meter">
                        <div class="strength-segment"></div>
                        <div class="strength-segment"></div>
                        <div class="strength-segment"></div>
                        <div class="strength-segment"></div>
                    </div>
                    <span class="strength-text">Fuerza de la contraseña</span>
                </div>
                
                <div class="password-requirements">
                    <h4>Tu contraseña debe contener:</h4>
                    <div class="requirement-item">
                        <i class="fas fa-circle"></i>
                        <span>Al menos 8 caracteres</span>
                    </div>
                    <div class="requirement-item">
                        <i class="fas fa-circle"></i>
                        <span>Al menos una letra mayúscula</span>
                    </div>
                    <div class="requirement-item">
                        <i class="fas fa-circle"></i>
                        <span>Al menos una letra minúscula</span>
                    </div>
                    <div class="requirement-item">
                        <i class="fas fa-circle"></i>
                        <span>Al menos un número</span>
                    </div>
                    <div class="requirement-item">
                        <i class="fas fa-circle"></i>
                        <span>Al menos un carácter especial</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu nueva contraseña" required>
                        <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                </div>
                
                <div class="passwords-match">
                    <i class="fas fa-times-circle"></i>
                    <span>Las contraseñas no coinciden</span>
                </div>
                
                <?php if (!empty($mensaje)): ?>
                    <div class="message">
                        <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="recovery-info">
                    <i class="fas fa-info-circle"></i>
                    <p>Asegúrate de crear una contraseña segura que no hayas utilizado antes. Una contraseña fuerte es la mejor protección para tu cuenta.</p>
                </div>
                
                <button type="submit" class="login-button" id="resetButton" >RESTABLECER CONTRASEÑA</button>
            </form>
            
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

    <script>
        // Script para mostrar/ocultar contraseñas
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            const resetButton = document.getElementById('resetButton');
            const passwordsMatch = document.querySelector('.passwords-match');
            const strengthSegments = document.querySelectorAll('.strength-segment');
            const strengthText = document.querySelector('.strength-text');
            const requirementItems = document.querySelectorAll('.requirement-item');
            
            // Función para alternar la visibilidad de la contraseña
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Validación de contraseñas
            function validatePasswords() {
                const passwordValue = password.value;
                const confirmValue = confirmPassword.value;
                
                // Verificar si las contraseñas coinciden
                if (confirmValue.length > 0) {
                    if (passwordValue === confirmValue) {
                        passwordsMatch.classList.add('valid');
                        passwordsMatch.classList.remove('invalid');
                        passwordsMatch.innerHTML = '<i class="fas fa-check-circle"></i><span>Las contraseñas coinciden</span>';
                    } else {
                        passwordsMatch.classList.add('invalid');
                        passwordsMatch.classList.remove('valid');
                        passwordsMatch.innerHTML = '<i class="fas fa-times-circle"></i><span>Las contraseñas no coinciden</span>';
                    }
                }
                
                // Verificar requisitos de contraseña
                const hasLength = passwordValue.length >= 8;
                const hasUpperCase = /[A-Z]/.test(passwordValue);
                const hasLowerCase = /[a-z]/.test(passwordValue);
                const hasNumber = /[0-9]/.test(passwordValue);
                const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
                
                // Actualizar indicadores de requisitos
                updateRequirement(0, hasLength);
                updateRequirement(1, hasUpperCase);
                updateRequirement(2, hasLowerCase);
                updateRequirement(3, hasNumber);
                updateRequirement(4, hasSpecial);
                
                // Calcular fuerza de la contraseña
                let strength = 0;
                if (hasLength) strength++;
                if (hasUpperCase) strength++;
                if (hasLowerCase) strength++;
                if (hasNumber) strength++;
                if (hasSpecial) strength++;
                
                updateStrengthMeter(strength);
                
                // Habilitar/deshabilitar botón de envío
                /*
                const allRequirementsMet = hasLength && hasUpperCase && hasLowerCase && hasNumber && hasSpecial;
                const passwordsMatch = passwordValue === confirmValue && confirmValue.length > 0;
                
                /*resetButton.disabled = !(allRequirementsMet && passwordsMatch);*/
            }
            
            function updateRequirement(index, isValid) {
                if (isValid) {
                    requirementItems[index].classList.add('valid');
                    requirementItems[index].querySelector('i').classList.remove('fa-circle');
                    requirementItems[index].querySelector('i').classList.add('fa-check-circle');
                } else {
                    requirementItems[index].classList.remove('valid');
                    requirementItems[index].querySelector('i').classList.add('fa-circle');
                    requirementItems[index].querySelector('i').classList.remove('fa-check-circle');
                }
            }
            
            function updateStrengthMeter(strength) {
                // Resetear clases
                strengthSegments.forEach(segment => {
                    segment.className = 'strength-segment';
                });
                
                // Actualizar texto de fuerza
                if (strength === 0) {
                    strengthText.textContent = 'Fuerza de la contraseña';
                } else if (strength <= 2) {
                    strengthText.textContent = 'Débil';
                    for (let i = 0; i < strength; i++) {
                        strengthSegments[i].classList.add('weak');
                    }
                } else if (strength <= 3) {
                    strengthText.textContent = 'Media';
                    for (let i = 0; i < strength; i++) {
                        strengthSegments[i].classList.add('medium');
                    }
                } else if (strength === 4) {
                    strengthText.textContent = 'Fuerte';
                    for (let i = 0; i < strength; i++) {
                        strengthSegments[i].classList.add('strong');
                    }
                } else {
                    strengthText.textContent = 'Muy fuerte';
                    for (let i = 0; i < strength; i++) {
                        strengthSegments[i].classList.add('very-strong');
                    }
                }
            }
            
            // Eventos para validación en tiempo real
            password.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);
        });
    </script>
</body>
</html>