<?php
include 'conexionbd.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['ci'])) {
    header("Location: login/registro.php");
    exit();
}

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])) {
    $ci = $_SESSION['ci'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el correo ya está registrado por otro usuario
    $sql_check = "SELECT * FROM usuario WHERE correo = '$correo' ";
    $res_check = $con->query($sql_check);
    if ($res_check->num_rows > 0) {
        header("Location: actualizarusuario.php?error=3");
        exit();
    }

    // Actualizar usuario
    $sql = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', correo = '$correo', telefono = '$telefono', contraseña = '$contraseña' WHERE correo = '$correo'";
    // Actualizar sesión
    if ($con->query($sql) === TRUE) {
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['email'] = $correo;
        header("Location: actualizarusuario.php?success");
        exit();
    } else {
        header("Location: actualizarusuario.php?error=1");
        exit();
    }
} else {
    header("Location: actualizarusuario.php?error=2");
    exit();
}
?>
