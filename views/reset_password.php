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
            background: linear-gradient(rgba(105, 28, 50, 0.7), rgba(105, 28, 50, 0.75)), url('../public/assets/img/fondoSIIE.jpg') no-repeat center center fixed;
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
            <h2 class="login-header mt-2">Sistema de Infraestructura Educativa (SIIE)</h2>
            <h3 class="login-header">Escribir nueva contraseña</h3>
        </div>
        <form action="#" class="login-box" id="resetForm">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

            <div class="mb-3">
                <label for="password" class="form-label">Nueva contraseña <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nueva contraseña" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar contraseña <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirm_password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>


            <div id="password-error" class="alert alert-danger d-none text-center mt-2">
                Las contraseñas no coinciden.
            </div>

            <button type="submit" class="btn btn-primary w-100">Actualizar contraseña</button>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mt-3 text-center">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3 text-center">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php endif; ?>

            <div class="text-end mt-2">
                <a href="/login">Volver a iniciar sesión</a>
            </div>
        </form>
    </div>

</body>

<script>
    function togglePassword(id, button) {
        const input = document.getElementById(id);
        const icon = button.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('resetForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;
        const token = document.querySelector('input[name="token"]').value;
        const errorDiv = document.getElementById('password-error');

        if (password !== confirm) {
            errorDiv.classList.remove('d-none');
            return;
        } else {
            errorDiv.classList.add('d-none');
        }

        const formData = new FormData();
        formData.append('password', password);
        formData.append('confirm_password', confirm);
        formData.append('token', token);

        try {
            const response = await fetch('/controllers/reset_controller.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña actualizada',
                    text: result.message || 'Tu contraseña ha sido cambiada correctamente.',
                    confirmButtonText: 'Iniciar sesión'
                }).then(() => {
                    window.location.href = '/login';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: result.message || 'Ocurrió un error al actualizar la contraseña.'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo completar la solicitud. Inténtalo más tarde.'
            });
        }
    });
</script>

</html>