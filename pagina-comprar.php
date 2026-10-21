<?php 
include "cabecera.php";
include "connection.php";   
$id_juego = $_GET['id'];
$idusu = $_GET['idusu'];

$sql = "SELECT * FROM  juegos where id_juego=:id_juego";
$stmt = $con->prepare($sql);
$stmt->execute([
            "id_juego" => $id_juego
        ]);
$juego = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $juego['nombre'] ?> - Xogaliza</title>
    <link rel="stylesheet" href="pagina-comprar.css">
</head>
<body>

<main class="purchase-page">
    <a class="back-link" href="comprar.php?idusu=<?= $idusu ?>">
        ← Volver a la tienda
    </a>
    
    <div class="purchase-card">
        <div class="purchase-art">
            <img src="sf_GameHub/<?= $juego['imagen'] ?>" alt="<?= $juego['nombre'] ?>">
        </div>

        <div class="purchase-info">
            <p class="purchase-label">JUEGO DE LA TIENDA</p>
            <h1><?= $juego['nombre'] ?></h1>

            <div class="purchase-bottom">
                <div class="price-box">
                    <span class="price-label">Precio</span>
                    <strong><?= $juego['precio'] ?></strong>
                </div>

                <a class="buy-button"
                   href="comprado.php?idusu=<?= $idusu ?>&id_juego=<?= $id_juego ?>">
                    Comprar juego
                </a>
            </div>
        </div>
</div>
</main>

</body>
</html>