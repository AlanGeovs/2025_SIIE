<?php
require_once __DIR__ . '/../config/db.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevo Registro - SIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            max-width: 670px;
            width: 100%;
        }

        .login-header {
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #691C32;
            border-color: #691C32;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #9F2241;
            border-color: #9F2241;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-success {
            background-color: #006837;
            border-color: #006837;
        }

        .btn-success:hover {
            background-color: #004d29;
            border-color: #004d29;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="text-center mb-4">
            <img src="../public/assets/img/logo-inifed.png" alt="INIFED" style="max-height: 80px;">
            <h2 class="login-header mt-3">Sistema de Infraestructura Educativa (SIIE)</h2>
            <h3 class="login-header">Nuevo Registro</h3>
        </div>
        <form id="registroForm" class="login-box">

            <div id="seccionCredenciales">
                <div class="mb-3">
                    <label for="correo" class="form-label">Registra un correo electrónico (institucional o personal) <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="contrasena" placeholder="Registra una contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena_confirm" class="form-label">Confirmar contraseña <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="contrasena_confirm" placeholder="Escribe nuevamente la contraseña" required>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="validarPrimeraSeccion()">Continuar</button>
                </div>
            </div>

            <div id="seccionDatosComplementarios" style="display: none;">
                <h5 class="mt-4 mb-3">Nombre de la o el director del centro de trabajo</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombres" placeholder="Ejemplo: Juan" required>
                    </div>
                    <div class="col-md-4">
                        <label>Apellido paterno <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="apellido_p" placeholder="Ejemplo: Flores" required>
                    </div>
                    <div class="col-md-4">
                        <label>Apellido materno <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="apellido_m" placeholder="Ejemplo: Fuentes" required>
                    </div>
                    <div class="col-md-6">
                        <label>Teléfono fijo <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="telefono_fijo" placeholder="Ejemplo: 55 2180 0452" required>
                    </div>
                    <div class="col-md-6">
                        <label>Teléfono móvil <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="telefono_movil" placeholder="Ejemplo: 55 3109 8005" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2 mt-4">
                    <button type="button" class="btn btn-secondary w-50" onclick="regresarACredenciales()">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </button>
                    <button type="submit" class="btn btn-primary w-50">
                        <i class="fas fa-user-plus"></i> Dar de alta
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function validarPrimeraSeccion() {
            const correo = document.getElementById('correo').value.trim();
            const pass1 = document.getElementById('contrasena').value;
            const pass2 = document.getElementById('contrasena_confirm').value;

            if (!correo || !pass1 || !pass2) {
                Swal.fire('Campos incompletos', 'Por favor completa todos los campos.', 'warning');
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(correo)) {
                Swal.fire('Correo inválido', 'Por favor introduce un correo electrónico válido.', 'error');
                return;
            }
            if (pass1 !== pass2) {
                Swal.fire('Contraseñas no coinciden', 'Verifica que ambas contraseñas sean iguales.', 'error');
                return;
            }

            document.getElementById('seccionCredenciales').style.display = 'none';
            document.getElementById('seccionDatosComplementarios').style.display = 'block';
        }

        function regresarACredenciales() {
            document.getElementById('seccionDatosComplementarios').style.display = 'none';
            document.getElementById('seccionCredenciales').style.display = 'block';
        }

        document.getElementById('registroForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const data = {
                correo: document.getElementById('correo').value.trim(),
                contrasena: document.getElementById('contrasena').value,
                nombres: document.getElementById('nombres').value.trim(),
                apellido_p: document.getElementById('apellido_p').value.trim(),
                apellido_m: document.getElementById('apellido_m').value.trim(),
                telefono_fijo: document.getElementById('telefono_fijo').value.trim(),
                telefono_movil: document.getElementById('telefono_movil').value.trim()
            };

            fetch('/controllers/registrar_usuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(res => res.json())
                .then(resp => {
                    if (resp.success) {
                        Swal.fire('Registro exitoso', 'Usuario registrado exitosamente.', 'success').then(() => {
                            window.location.href = '/login';
                        });
                    } else {
                        Swal.fire('Error', resp.message, 'error');
                    }
                }).catch(err => {
                    console.error(err);
                    Swal.fire('Error en el servidor', 'Intenta nuevamente más tarde.', 'error');
                });
        });
    </script>
</body>

</html>