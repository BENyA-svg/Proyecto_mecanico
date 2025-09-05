<?php
include 'conexionbd.php';

session_start();

if (isset($_POST['cerrar'])) {
    session_unset();
    session_destroy();
    header("Location: inicio1.php");
    exit();
}
if (!empty($_POST['submit'])){
if (empty($_POST['email']) || empty($_POST['contraseña'])) {
   echo "No se proporcionaron email o contraseña.";
   exit();
}
if (isset($_REQUEST['email']) && isset($_REQUEST['contraseña'])) {
    $email = $_REQUEST['email'];
    $contraseña = $_REQUEST['contraseña'];
    $sql =" SELECT * FROM usuario WHERE correo = '$email' AND contraseña = '$contraseña'";
    $res = $con->query($sql);
    if ($res->num_rows > 0) {
     $sesion = $res->fetch_assoc();

       $_SESSION['ci'] = $sesion["ci"];
        $_SESSION['nombre'] = $sesion["nombre"];
        $_SESSION['apellido'] = $sesion["apellido"];
        $_SESSION['email'] = $sesion["correo"];

    }else{
       echo "Error: Usuario o contraseña incorrectos.";
        exit();
    }

 }else {
    echo "Error: No se proporcionaron email o contraseña.";
   exit();
}
}
if (isset($_REQUEST['perfil'])) {
    $_SESSION['perfil'] = $_REQUEST['perfil'];
}
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro' && !isset($_SESSION['servicios'])) {
    $_SESSION['servicios'] = [
        [
            'vehiculo' => 'Chevrolet Onix',
            'fecha' => '15/08/2025',
            'tipo' => '10000km',
            'desc' => 'Cambio de aceite y revisión general.',
            'estado' => 'Pendiente'
        ],
        [
            'vehiculo' => 'Toyota Corolla',
            'fecha' => '20/08/2025',
            'tipo' => '20000km',
            'desc' => 'Cambio de pastillas de freno y alineación.',
            'estado' => 'Pendiente'
        ],
         [
            'vehiculo' => 'Ford Raptor',
            'fecha' => '30/08/2025',
            'tipo' => '30000km',
            'desc' => 'Cambio de pastillas de freno, aceite y alineación.',
            'estado' => 'Pendiente'
        ]
    ];
}


header("Location: inicio1.php");
?>