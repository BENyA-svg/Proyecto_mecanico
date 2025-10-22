<?php
 $Servidor = "localhost";
 $Usuario = "root";
 $pass = "";
 $bd = "mecanico";
 $port="3306";
 $con = mysqli_connect($Servidor, $Usuario, $pass, $bd, $port);
 if (!$con) {
     die("Error de conexión: " . mysqli_connect_error());
 }
?>