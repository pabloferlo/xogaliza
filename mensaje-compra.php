<?php
include "connection.php";

$id_juego = $_GET['id_juego'];
$idusu = $_GET['idusu'];

$sql = "SELECT nombre FROM juegos WHERE id_juego = :id_juego";
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
    <title>Compra realizada</title>
    <style>
        body { background:#1e1e1e; color:#fff; font-family:Arial; text-align:center; padding-top:100px; }
        .box { background:#2b2b2b; padding:30px; width:400px; margin:auto; border-radius:10px; }
        a { color:#4ea3ff; text-decoration:none; }
    </style>
</head>
<body>

<div class="box">
    <h2>Compra realizada con éxito</h2>
    <p>Has comprado: <b><?= $juego['nombre'] ?></b></p>
    <br>
    <a href="comprar.php?idusu=<?=$idusu?>">Volver a compras</a>
</div>

</body>
</html>