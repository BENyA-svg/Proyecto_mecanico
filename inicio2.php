<?php
session_start();

if (isset($_REQUEST['email'])) {
    $_SESSION['email'] = $_REQUEST['email'];
}

if (isset($_REQUEST['contraseña'])) {
    $_SESSION['contraseña'] = $_REQUEST['contraseña'];
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

if (isset($_POST['cerrar'])) {
    session_unset();
    session_destroy();
    header("Location: inicio1.php");

    header("Location: inicio1.php");
}
header("Location: inicio1.php");
?>