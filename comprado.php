<?php 
session_start();
include "connection.php";

$idusu = $_GET['idusu'];
$id_juego = $_GET['id_juego'];

// Inserir o xogo na táboa usuarios_juegos
$sql = "INSERT INTO usuarios_juegos (id_usuario, id_juegos) VALUES (:idusu, :id_juego)";
$stmt = $con->prepare($sql);
$stmt->execute([
    "idusu" => $idusu,
    "id_juego" => $id_juego
]);

// Redirixir á páxina de confirmación
header("Location: mensaje-compra.php?id_juego=$id_juego&idusu=$idusu");
exit();
?>