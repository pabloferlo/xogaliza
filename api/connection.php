<?php
$servidorBD='localhost';
$usuarioBD='admin';
$passwordBD='admingame';
$nombreBD='gamehub';
$dsn = "mysql:host=$servidorBD;dbname=$nombreBD";
try {
    $con = new PDO($dsn, $usuarioBD, $passwordBD);
    // unset($passwordBD); // modo paranoico
}
catch (PDOException $ex) {
 exit('No se ha podido conectar con la BD:<br>'.$ex->getMessage());
}
