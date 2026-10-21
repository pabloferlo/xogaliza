<?php 
include "cabecera.php";
include "connection.php";   

$id_juego = $_GET['idjuego'];
$nombreusu = $_SESSION['nombreusu'];
$id = $_SESSION['id'];

$sql = "SELECT * FROM  juegos where id_juego=:id_juego";
$stmt = $con->prepare($sql);
$stmt->execute([
            "id_juego" => $id_juego
        ]);
$juego = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM  usuarios_juegos where id_juegos=:id_juego and id_usuario=:id";
$stmt = $con->prepare($sql);
$stmt->execute([
            "id_juego" => $id_juego,
            "id" => $id

        ]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="play.css">

<div class="play-page">
    <div class="topbar">
        <a href="index.php">Biblioteca</a> / <?= $juego["nombre"] ?>
    </div>

    <div class="game-panel">
        <div class="game-art">
            <img src="sf_GameHub/<?= $juego['imagen'] ?>" alt="<?= $juego['nombre'] ?>">
        </div>

        <div class="game-info">
            <div class="label">Tu biblioteca</div>
            <h1><?= $juego["nombre"] ?></h1>

            <?php if ($game["estado"] == "no_instalado"): ?>

                <div class="status">No instalado</div>
                <p class="size">
                    Tamaño de descarga: <?= $juego["peso"] ?> 
                </p>

                <div class="actions">
                    <a class="button button-main"
                       href="instalando.php?id=<?= $id_juego ?>">
                        Instalar
                    </a>
                </div>

            <?php else: ?>

                <div class="status">Instalado</div>

                <?php if (isset($_GET['instalado'])): ?>
                    <p class="success">Se instaló correctamente.</p>
                <?php endif; ?>

                <div class="actions">
                    <a class="button button-main" href="">Iniciar</a>

                    <a class="button button-danger"
                       href="desinstalando.php?id=<?= $id_juego ?>">
                        Desinstalar
                    </a>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

