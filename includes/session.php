<?php
session_start();

// Expira sesión a 1 hora (3600 segundos)
ini_set('session.gc_maxlifetime', 3600);
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > 3600) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

function isLoggedIn()
{
    return isset($_SESSION['usuario_id']);
}

function isAdmin()
{
    return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
}

function redirigirSiNoLogeado()
{
    if (!isLoggedIn()) {
        header('Location: login');
        exit;
    }
}
