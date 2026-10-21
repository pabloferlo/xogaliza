<?php
ob_start();
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
// 1. Iniciamos sesión para poder leer los datos del usuario logueado

// 2. CONTROL DE ACCESO: Si la variable 'usuario' no existe, es que no ha pasado por el login
if (!isset($_SESSION['nombreusu'])) {
    header("Location: login.php"); // Redirigimos al formulario de acceso
    exit(); // Cortamos la ejecución para que no se cargue nada más
}


// Datos de sesión
$nombreusu = $_SESSION['nombreusu'];
$rol=$_SESSION['rol'];

?>
<link rel="stylesheet" href="comun.css">
<div class="user-bar">
    <div class="user-info">
        <b>Usuario: <?= $nombreusu ?></b>
        <span>Rol: <?= $rol ?></span>
    </div>

    <a class="logout-link" href="cerrar.php">Cerrar sesión</a>
</div>