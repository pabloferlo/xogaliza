<?php
session_start();
include "connection.php";

if (isset($_POST["btn_registrar"])) {
    $nombreusu = $_POST["nombreusu"];
    $contrasena = $_POST["contrasena"];
    $sqlExiste = "SELECT id FROM usuarios WHERE nombreusu = :nombreusu";
    $stmtExiste = $con->prepare($sqlExiste);
    $stmtExiste->execute([
        "nombreusu" => $nombreusu
    ]);
    if ($stmtExiste->fetch()) {
        $error = "Ese usuario ya existe.";
    } else {
        $sqlRegistro = "INSERT INTO usuarios (nombreusu, contrasena) VALUES (:nombreusu, :contrasena)";
        $stmtRegistro = $con->prepare($sqlRegistro);
        $stmtRegistro->execute([
            "nombreusu" => $nombreusu,
            "contrasena" => $contrasena
        ]);
        header("Location: login.php?registro=exito");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Xogaliza</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main class="login-page">
        <section class="login-box">
            <div class="login-logo">G</div>

            <h1>Xogaliza</h1>
            <p class="login-subtitle">Crea tu cuenta</p>

            <?php if (isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" class="login-form">
                <label for="nombreusu">Usuario</label>
                <input
                    type="text"
                    id="nombreusu"
                    name="nombreusu"
                    placeholder="Escribe tu usuario"
                    required
                >

                <label for="contrasena">Contraseña</label>
                <input
                    type="password"
                    id="contrasena"
                    name="contrasena"
                    placeholder="Escribe tu contraseña"
                    required
                >

                <button type="submit" name="btn_registrar">Regístrate</button>
            </form>

            <p style="text-align: center; margin-top: 15px;">
                ¿Ya tienes cuenta? <a href="login.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Inicia sesión aquí</a>
            </p>
        </section>
    </main>
</body>
</html>
