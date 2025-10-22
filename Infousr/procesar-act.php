<?php
include '../conexionbd.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['ci'])) {
    header("Location: login/registro.php");
    exit();
}

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['telefono'])) {
    $ci = $_SESSION['ci'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];

$sql = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono'";
    // Verificar si el correo ya está registrado por otro usuario
    $sql_check = "SELECT * FROM usuario WHERE correo = '$correo' AND correo <> '$_SESSION[email]'";
    $res_check = $con->query($sql_check);
    if ($res_check->num_rows > 0) {
        header("Location: infousr.php?error=3");
        exit();
    }else{  
        $sql .= ", correo = '$correo' ";
    }

    // Actualizar usuario
    
    // Actualizar sesión
    if (!empty($_POST['contraseña'])) {
        $contraseña = $_POST['contraseña'];
        $sql .= ", contraseña = '$contraseña'";
       
    }
    $sql .= " WHERE correo = '$_SESSION[email]'";
    
  
    
    if ($con->query($sql) === TRUE) {
        
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['email'] = $correo;
        if($_SESSION['perfil']=='cliente'){
            $nacimiento = !empty($_POST['nacimiento']) ? $_POST['nacimiento'] : '';
            $direccion = !empty($_POST['direccion']) ? $_POST['direccion'] : '';
            $sql_cliente = "UPDATE clientes SET direccion = '$direccion', fecha_nacimiento = '$nacimiento' WHERE correo = '$_SESSION[email]'";
            $con->query($sql_cliente);
        }elseif($_SESSION['perfil']=='centro'){
            $n_centro = !empty($_POST['n_centro']) ? $_POST['n_centro'] : '';
            $ubicacion_c = !empty($_POST['ubicacion_c']) ? $_POST['ubicacion_c'] : '';
            $sql_centro = "UPDATE centros SET nom_centro = '$n_centro', ubicacion = '$ubicacion_c' WHERE correo = '$_SESSION[email]'";
            $con->query($sql_centro);
        }
        header("Location: infousr.php?success");
        exit();
    } else {
        header("Location: infousr.php?error=1");
        exit();
    }
} else {
    header("Location: infousr.php?error=2");
    exit();
}
?>
