<?php


$Servidor = "26.196.49.52";
$Usuario = "wolfcrew";
$pass = "";
$bd = "mecanico";
$port="3306";
$con = mysqli_connect($Servidor, $Usuario, $pass, $bd, $port);
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}else {
    echo "Conexión exitosa a la base de datos.";
}
?>