<?php
session_start();
include 'conexionbd.php';
include 'lang.php';
if (isset($_POST['cerrar'])) {
    $current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
    session_unset();
    session_destroy();
    header("Location: inicio1.php?lang=" . $current_lang);
    exit();
}

if (empty($_POST['email']) || empty($_POST['contraseña'])) {
   header("Location: ./login/registro.php?error=2&lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
   exit();
}

if (isset($_REQUEST['email']) && isset($_REQUEST['contraseña'])) {
    $email = $_REQUEST['email'];
    $contraseña = $_REQUEST['contraseña'];
    $sql ="SELECT * FROM usuario WHERE correo = '".$email."' AND contraseña = '".$contraseña."'";
    $res = $con->query($sql);
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['ci'] = $row["ci"];
        $_SESSION['nombre'] = $row["nombre"];
        $_SESSION['apellido'] = $row["apellido"];
        $_SESSION['email'] = $row["correo"];

        // Consulta para definir el perfil/cargo automáticamente
        $sel2 = "SELECT correo, 'cliente' AS cargo
            FROM clientes
            WHERE correo = '" . $row["correo"] . "'
            UNION
            SELECT correo, 'centro' AS cargo
            FROM centros
            WHERE correo = '" . $row["correo"] . "' 
            UNION
            SELECT correo, 'ventas' AS cargo
            FROM ventas
            WHERE correo = '".$row["correo"]."'
            LIMIT 1;";
        $res2 = $con->query($sel2);

        if ($res2 && $res2->num_rows > 0) {
            $cargoRow = $res2->fetch_assoc();
            $_SESSION['perfil'] = $cargoRow['cargo'];
        } else {
            $_SESSION['perfil'] = 'usuario'; // Valor por defecto si no se encuentra
        }

        // Ensure language is set in session after login
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'es';
        }

    } else {
        header("Location: ./login/registro.php?error=1&lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
        exit();
    }
} else {
   exit();
}

header("Location: inicio1.php?lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
?>
