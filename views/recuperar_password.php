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
            <h3 class="login-header">Recuperar contraseña</h3>
        </div>
        <form action="#" method="POST" class="login-box" id="form-recuperar">
            <div class="mb-3">
                <label for="correo" class="form-label">Dirección de correo electrónico <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa el email registrado" required>
                </div>
            </div>
            <p class="text-muted small">Recibirás un enlace por correo electrónico para restablecer tu contraseña.</p>
            <button type="submit" class="btn btn-primary w-100">Enviar instrucciones</button>

            <div id="alertContainer"></div>

            <div class="text-end mt-2">
                <a href="/login">Volver a iniciar sesión</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('form-recuperar').addEventListener('submit', function(e) {
            e.preventDefault();

            const correo = document.getElementById('correo').value;

            fetch('/controllers/recuperar_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        correo: correo
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Instrucciones enviadas!',
                            text: data.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo enviar la solicitud. Inténtalo más tarde.'
                    });
                });
        });
    </script>
</body>

</html>