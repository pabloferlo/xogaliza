<?php 
include "cabecera.php";
include "connection.php";   

$idusu = $_GET['idusu'];


$sql = "SELECT *
FROM juegos
WHERE id_juego NOT IN (
    SELECT id_juegos
    FROM usuarios_juegos
    WHERE id_usuario = :idusu);";
$stmt = $con->prepare($sql);
$stmt->execute([
            "idusu" => $idusu
        ]);
$juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xogaliza - Comprar juegos</title>
    <link rel="stylesheet" href="comprar.css">
</head>
<body>

<main class="store-page">
    <div class="store-header">
        <div>
            <p class="store-label">Xogaliza</p>
            <h1>Tienda de juegos</h1>
            <p class="store-subtitle">Encuentra tu próximo juego favorito.</p>
        </div>

        <a class="back-button" href="index.php">Volver a mi biblioteca</a>
    </div>

    <?php if (count($juegos) > 0): ?>
        <div class="store-grid">
            <?php foreach ($juegos as $j): ?>
                <article class="store-card">
                    <div class="store-card-art">
                        <img src="sf_GameHub/<?= $j['imagen'] ?>" alt="<?= $j['nombre'] ?>">
                    </div>

                    <div class="store-card-info">
                        <h2><?= $j['nombre'] ?></h2>

                        <div class="store-card-bottom">
                            <p class="store-price">
                                Precio: <?= $j['precio'] ?>
                            </p>

                            <a class="buy-button"
                               href="pagina-comprar.php?id=<?= $j['id_juego'] ?>&idusu=<?= $idusu ?>">
                                Ver y comprar
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-store">
            <h2>Ya tienes todos los juegos</h2>
            <p>No hay más juegos disponibles para comprar.</p>
            <a class="buy-button" href="index.php">Volver a mi biblioteca</a>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
