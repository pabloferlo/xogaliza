<?php
include "cabecera.php";
include "connection.php";
$nombreusu = $_SESSION['nombreusu'];
$rol = $_SESSION['rol'];
$sql = "SELECT id_juego,nombre,categoria,descripcion,imagen FROM usuarios inner join usuarios_juegos on id=id_usuario inner join juegos on id_juego=id_juegos where nombreusu=:nombreusu";
$stmt = $con->prepare($sql);
$stmt->execute([
            "nombreusu" => $nombreusu
        ]);
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM usuarios where nombreusu=:nombreusu";
$stmt = $con->prepare($sql);
$stmt->execute([
            "nombreusu" => $nombreusu
        ]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xogaliza - Panel</title>
    <link rel="stylesheet" href="index.css">
    
</head>
<body>

<div class="dashboard">

    <header class="dashboard-header">
        <div class="brand">
            <span class="brand-icon">G</span>
            <div>
                <h1 class="brand-title">Xogaliza</h1>
                <p class="brand-subtitle">Tu biblioteca de juegos</p>
            </div>
        </div>

        <a class="buy-button" href="comprar.php?idusu=<?= $usuario["id"] ?>">
            Comprar juegos
        </a>
    </header>

    <main class="library">
        <div class="section-heading">
            <div>
                <p class="section-label">MI COLECCIÓN</p>
                <h2>Juegos en propiedad</h2>
            </div>

            <span class="game-count">
                <?= count($equipos) ?> juegos
            </span>
        </div>

        <?php if (count($equipos) > 0): ?>
            <div class="game-grid">

                <?php foreach ($equipos as $e): ?>
                    <article class="game-card">
                        <a class="game-card-link"
                           href="play.php?idjuego=<?= $e["id_juego"] ?>">

                            <div class="game-card-art">
                                <img src="sf_GameHub/<?= $e['imagen'] ?>" >
                            </div>

                            <div class="game-card-info">
                                <h3 class="game-title"><?= $e["nombre"] ?></h3>

                                <p class="game-category">
                                    <?= $e["categoria"] ?>
                                </p>

                                <p class="game-description">
                                    <?= $e["descripcion"] ?>
                                </p>

                                <span class="game-card-action">
                                    Ver juego →
                                </span>
                            </div>

                        </a>
                    </article>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <div class="empty-library">
                <h3>Aún no tienes juegos</h3>
                <p>Visita la tienda para añadir juegos a tu biblioteca.</p>
                <a class="buy-button"
                   href="comprar.php?idusu=<?= $usuario["id"] ?>">
                    Explorar juegos
                </a>
            </div>
        <?php endif; ?>
    </main>

</div>

</body>
</html>