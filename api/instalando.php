<?php
session_start();
include "connection.php";

$id_juego = $_GET['id'];
$nombreusu = $_SESSION['nombreusu'];

$sql = "SELECT nombre
        FROM juegos
        WHERE id_juego = :id_juego";

$stmt = $con->prepare($sql);
$stmt->execute([
    "id_juego" => $id_juego
]);
$juego = $stmt->fetch(PDO::FETCH_ASSOC);

echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instalando - Xogaliza</title>
    <link rel="stylesheet" href="instalando.css">
</head>
<body>
    <main class="install-page">
        <section class="install-card">
            <div class="install-icon">G</div>
            <p class="install-label">Xogaliza</p>
            <h1>Instalando ' . htmlspecialchars($juego['nombre']) . '</h1>
            <p class="install-message">Preparando el juego para tu biblioteca...</p>

            <div class="progress-bar">
                <div class="progress"></div>
            </div>

            <p class="install-time">La instalación tardará unos segundos.</p>
';

if (ob_get_level() > 0) {
    ob_flush();
}
flush();

sleep(5);

$sql = "UPDATE usuarios_juegos
        SET estado = 'instalado'
        WHERE id_usuario = (
            SELECT id FROM usuarios WHERE nombreusu = :nombreusu
        )
        AND id_juegos = :id_juego
        AND estado = 'no_instalado'";

$stmt = $con->prepare($sql);
$stmt->execute([
    "nombreusu" => $nombreusu,
    "id_juego" => $id_juego
]);

if ($stmt->rowCount() > 0) {
    echo '<p class="install-success">Se instaló correctamente.</p>';
} else {
    echo '<p class="install-error">No se pudo instalar el juego.</p>';
}

echo '
            <a class="install-link" href="play.php?id=' . $id_juego . '">
                Volver al juego
            </a>
        </section>
    </main>
</body>
</html>';
?>
