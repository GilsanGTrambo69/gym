<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - GYM</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <a href="index.html" class="logo">
                    <img > <!--lOGO DEL GYM-->
                </a>
                <h1>CREA TU <span>CUENTA</span></h1>
                <p>Regístrate para comenzar tu entrenamiento personalizado</p>
            </div>
            
            <form class="login-form" id="registerForm" method="POST" action="validar_registro.php">
                <div class="form-group">
                    <label for="firstName">Nombre</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="firstName" name="firstName" placeholder="Tu nombre" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="lastName">Apellido</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="lastName" name="lastName" placeholder="Tu apellido" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                        <?php 
                        if (isset($_SESSION['email_error'])) { ?>
                        <div class="error" ><?php echo $_SESSION['email_error']; unset($_SESSION['email_error']); ?></div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone" placeholder="Tu número de teléfono" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Crea una contraseña segura" required>
                        <i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter">
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                        </div>
                        <span class="strength-text">Fuerza de contraseña</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirmar contraseña</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Repite tu contraseña" required>
                    </div>
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Acepto los <a href="#" class="terms-link">términos y condiciones</a></label>
                    </div>
                </div>
                
                <button type="submit" class="login-button">CREAR CUENTA</button>
                
            </form>
            
            <div class="register-link">
                ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Password strength meter
            const strengthSegments = document.querySelectorAll('.strength-segment');
            const strengthText = document.querySelector('.strength-text');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                // Reset all segments
                strengthSegments.forEach(segment => {
                    segment.classList.remove('weak', 'medium', 'strong', 'very-strong');
                });
                
                if (password.length > 0) {
                    // Check length
                    if (password.length >= 8) strength++;
                    
                    // Check for numbers
                    if (/\d/.test(password)) strength++;
                    
                    // Check for special characters
                    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
                    
                    // Check for uppercase and lowercase
                    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                    
                    // Update strength meter
                    for (let i = 0; i < strength; i++) {
                        if (strength === 1) {
                            strengthSegments[i].classList.add('weak');
                            strengthText.textContent = 'Débil';
                        } else if (strength === 2) {
                            strengthSegments[i].classList.add('medium');
                            strengthText.textContent = 'Media';
                        } else if (strength === 3) {
                            strengthSegments[i].classList.add('strong');
                            strengthText.textContent = 'Fuerte';
                        } else if (strength === 4) {
                            strengthSegments[i].classList.add('very-strong');
                            strengthText.textContent = 'Muy fuerte';
                        }
                    }
                } else {
                    strengthText.textContent = 'Fuerza de contraseña';
                }
            });
            
            // Form validation
            const registerForm = document.getElementById('registerForm');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                // Check if passwords match
                if (password !== confirmPassword) {
                    alert('Las contraseñas no coinciden');
                    return;
                }
                
                this.submit();
                
                // Phone validation
                /*
                const phone = document.getElementById('phone').value;
                const phoneRegex = /^[0-9]{9,15}$/; // Simple validation for phone numbers
                
                if (!phoneRegex.test(phone)) {
                    alert('Por favor, introduce un número de teléfono válido');
                    return;
                }
                
                // Here you would typically send the data to your server
                console.log('Registration attempt:', {
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    username: document.getElementById('username').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    password: password
                });
                
                // For demo purposes, show success message
                alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
                window.location.href = 'login.html'; */
            });
        });
    </script>
</body>
</html>
