<?php
$title = 'Inicio de sesión';
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(105, 28, 50, 0.7), rgba(105, 28, 50, 0.75)), url('../public/assets/img/inifed-sistema-alerta-de-daños-SIA-bg de tamaño grande-min.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .login-header {
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #691C32;
            border-color: #691C32;
        }

        .btn-primary:hover {
            background-color: #9F2241;
            border-color: #9F2241;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="text-center mb-2">
            <img src="/public/assets/img/logo-inifed.png" alt="INIFED" style="max-height: 80px;">
            <img src="/public/assets/img/agroasemex.png" alt="INIFED" style="max-height: 80px;">
            <h2 class="login-header mt-2">Sistema de Infraestructura Educativa (SIIE)</h2>
            <h3 class="login-header">Iniciar sesión</h3>
        </div>
        <form action="/controllers/acceso_controller.php" method="POST" class="login-box">
            <div class="mb-3">
                <label for="correo" class="form-label">Dirección de correo electrónico <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa el email que registraste" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mt-3 text-center">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>
            <div class="text-end mt-2">
                <a href="/recuperar">Olvidé mi contraseña</a>
            </div>
        </form>
    </div>

    <!-- Script para mostrar contraseñas -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>