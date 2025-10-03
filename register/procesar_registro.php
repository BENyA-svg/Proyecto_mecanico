<?php


include ('../conexionbd.php');
session_start();

if (!empty($_POST['Usuario']) && !empty($_POST['apellido']) && !empty($_POST['cedula']) && !empty($_POST['email']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])) {
    $nombre = $_POST['Usuario'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['cedula'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];

  
    $sql_check = "SELECT * FROM usuario WHERE correo = '$correo' OR ci = '$ci'";
    $res_check = $con->query($sql_check);
    if ($res_check->num_rows > 0) {
        header("Location: registrarse.php?error=3");
        exit();
    }

    $sql1 = "INSERT INTO usuario (ci, nombre, apellido, correo, telefono, contraseña) VALUES ('$ci', '$nombre', '$apellido', '$correo', '$telefono', '$contraseña')";
    $sql2 = "INSERT INTO clientes (ci_cliente, correo) VALUES ('$ci', '$correo')";
if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE) {
   header("Location: registrarse.php?creado");
        exit();
    } else {
        header("Location: registrarse.php?error=1");
        exit();
    }
} else {
    header("Location: registrarse.php?error=2");
    exit();
}

?>
