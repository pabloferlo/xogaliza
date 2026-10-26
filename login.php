<?php
session_start();
include "connection.php"; // conexión a la BD
ó
if (isset(($_POST["btn_entrar"]))) {
    $nombreusu = $_POST["nombreusu"];
    $contrasena = $_POST["contrasena"];
    $sql2 = "SELECT id, nombreusu, contrasena, rol FROM usuarios WHERE nombreusu = :nombreusu and contrasena=:contrasena";
    $stmt2 = $con->prepare($sql2);
    $stmt2->execute(
        [
            "nombreusu" => $nombreusu,
            "contrasena" => $contrasena
        ]
    );
    $login = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($login) {
        $_SESSION['nombreusu'] = $login['nombreusu'];
        $_SESSION['id'] = $login['id'];
        $_SESSION['rol']= $login['rol'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario incorrecto.";
    }
}

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
$sqlRegistro = "INSERT INTO usuarios (nombreusu, contrasena)
VALUES (:nombreusu, :contrasena)";
$stmtRegistro = $con->prepare($sqlRegistro);
$stmtRegistro->execute([
"nombreusu" => $nombreusu,
"contrasena" => $contrasena
]);
$mensaje = "Cuenta creada correctamente.";
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Xogaliza</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main class="login-page">
        <section class="login-box">
            <div class="login-logo">G</div>

            <h1>Xogaliza</h1>
            <p class="login-subtitle">Inicia sesión en tu cuenta</p>

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

                <button type="submit" name="btn_entrar">Entrar</button>
                
            </form>
            <p style="text-align: center; margin-top: 15px;">
                ¿No tienes cuenta? <a href="registro.php" style="color: #007bff; text-decoration: none; font-weight: bold;">Regístrate aquí</a>
            </p>
        </section>
    </main>
</body>
</html>
