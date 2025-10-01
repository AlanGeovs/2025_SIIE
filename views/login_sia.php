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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PKLQ7PBGYQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PKLQ7PBGYQ');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Agrega style.css     -->
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../public/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../public/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../public/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../public/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../public/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../public/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../public/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../public/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../public/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../public/assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../public/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../public/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../public/assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../public/assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <style>
        body {
            background: linear-gradient(rgba(30, 91, 79, 0.7), rgba(30, 91, 79, 0.7)), url('../public/assets/img/inifed-sistema-alerta-de-daños-SIA-bg de tamaño grande-min.jpeg') no-repeat center center fixed;
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

        </div>
        <form id="loginForm" class="login-box">
            <div class="mb-3">
                <label for="cct" class="form-label">Clave del Centro de Trabajo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-school"></i></span>
                    <input type="text" class="form-control" id="cct" name="cct" placeholder="Ejemplo: 15EJN4255J" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm_cct" class="form-label">Confirma la Clave del Centro de Trabajo <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="text" class="form-control" id="confirm_cct" name="confirm_cct" placeholder="Ejemplo: 15EJN4255J" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Reporte</button>


            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger mt-3 text-center">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

        </form>
    </div>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const cctInput = document.getElementById('cct');
        cctInput.addEventListener('input', () => cctInput.value = cctInput.value.toUpperCase());
        cctInput.addEventListener('blur', function() {
            const cct = cctInput.value.trim().toUpperCase();
            let isValid = true;
            let msg = '';
            const regex = /^([0-2][0-9]|3[0-3])[A-Z]{3}[0-9]{4}[A-Z]$/;

            if (!regex.test(cct)) {
                isValid = false;
                msg = 'El formato general del CCT no es correcto.';
            } else {
                const entidad = parseInt(cct.substring(0, 2), 10);
                const letrasServicio = cct.substring(3, 5);
                const numeroCentro = cct.substring(5, 9);
                const verificador = cct.charAt(9);

                if (entidad < 1 || entidad > 33) {
                    isValid = false;
                    msg = 'Entidad no válida (01 a 33).';
                } else if (!/^[A-Z]{2}$/.test(letrasServicio)) {
                    isValid = false;
                    msg = 'Caracteres 4 y 5 deben ser letras.';
                } else if (!/^\d{4}$/.test(numeroCentro)) {
                    isValid = false;
                    msg = 'Caracteres 6 al 9 deben ser numéricos.';
                } else if (!/^[A-Z]$/.test(verificador)) {
                    isValid = false;
                    msg = 'El último carácter debe ser letra.';
                }
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'CCT inválido',
                    text: msg
                }).then(() => {
                    cctInput.focus();
                    cctInput.select();
                });
                cctInput.style.borderColor = 'red';
            } else {
                cctInput.style.borderColor = 'green';
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const cct = document.getElementById('cct').value.trim().toUpperCase();
            const confirmCct = document.getElementById('confirm_cct').value.trim().toUpperCase();

            if (cct !== confirmCct) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Los valores del CCT no coinciden.'
                });
                return;
            }

            fetch('/controllers/login_controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        cct1: cct,
                        cct2: confirmCct
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/captura-reporte';
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en el servidor. Intente más tarde.'
                    });
                });
        });
    </script>

</body>

</html>