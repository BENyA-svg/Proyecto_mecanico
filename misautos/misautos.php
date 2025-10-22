<?php
include ('../conexionbd.php');
session_start();

$mis_autos_ejemplo = [
    [
        'usuario' => 'Juancito',
        'marca' => 'Ford',
        'modelo' => 'Focus',
        'fecha_compra' => '2025-05-11'
    ]
];

$_SESSION['mis_autos'] = $mis_autos_ejemplo;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Mis Autos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vehiculos.css"> 
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        
        <?php if (isset($_SESSION['perfil'])): ?>
            <h2>Perfil <?php echo $_SESSION['perfil']; ?></h2>
        <?php endif; ?>
        
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> | 
            
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>   
                <a href="../solservicio/servicios.php" class="text-white">Servicios</a> |
                <a href="misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="/aautos/aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="/insumos/insumos.php" class="text-white">Insumos</a> |
                <a href= "allusr/usuarios.php" class="text-white">Usuarios</a> |

            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="/login/registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="../inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="btn btn-link text-white p-0" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>
    
    <div class="container mt-5">
        <h3 class="form-title">Mis Vehículos</h3>
        <div class="form-container">

        <!-- ACA VAMOS A TRABAJAR AHORA-->
 <?php  
$sel = "SELECT * FROM auto WHERE correo='".$_SESSION['email']."';";    
$res = $con->query($sel);
if ($res->num_rows > 0) {
    while($fila = $res->fetch_assoc()) {
        ?><div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <img src="./images/ford_focus.jpeg" alt="Ford Focus" class="auto-imagen me-3">
                <div>
        <?php
             echo "<h5 class=\"card-title\">" . ($fila['marca'] . ' ' . $fila['modelo'] . ' ' . $fila['año']) . "</h5>";
               echo "<p class=\"card-text\">" ."<strong>Matricula:</strong>" .($fila['matricula'] . 
               '<br><strong>Numero de chasis:</strong> ' . $fila['n_chasis'].
               ' <br><strong>Numero de motor:</strong>' . $fila['n_motor']) . 
               ' <br><strong>Estado de garantia:</strong>' . $fila['estado_g'] . "</p>".
               ' <br><strong>Fecha de compra:</strong>' . $fila['fecha_compra'] . "</p>";
           ?></div>
</div>
</div>
        <?php
    }
}else{
    echo "<tr><td colspan='7'>No hay vehículos registrados.</td></tr>";
}
    echo "</table>";

?>
               
        
 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
