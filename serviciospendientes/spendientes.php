<?php
include ('../conexionbd.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="servicependiente.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
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
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>  
                <a href="spendientes.php" class="text-white">Servicios pendientes</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>  
                <a href="servicios.php" class="text-white">Servicios</a> | 
                <a href="misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos.php" class="text-white">Insumos</a> |
                <a href= "usuarios.php" class="text-white">Usuarios</a> |

            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="../inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="btn btn-link text-white p-0" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>

    </div>
    <h3 class="form-title">Servicios Pendientes</h3>
    <div class="container">
        <div class="service">

            
     <?php

    $sel = "SELECT * FROM servicios";    
    $res = $con->query($sel);
    if ($res->num_rows > 0) {
        echo "<table>";
        echo "<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Matricula</th>
    <th>Fecha Service</th>
    <th>Costos</th>
    <th>Requisitos</th>
    <th>N° Chasis</th>
    <th>N° Motor</th>
</tr>";
        while($fila = $res->fetch_assoc()) {
         echo "<tr>";
    echo "<td>" . ($fila["id_service"] ?? '') . "</td>";
    echo "<td>" . ($fila["nombre"] ?? '') . "</td>";
    echo "<td>" . ($fila["descripcion"] ?? '') . "</td>";
    echo "<td>" . ($fila["matricula"] ?? '') . "</td>";
    echo "<td>" . ($fila["fecha_service"] ?? '') . "</td>";
    echo "<td>" . ($fila["costos"] ?? '') . "</td>";
    echo "<td>" . ($fila["requisitos"] ?? '') . "</td>";
    echo "<td>" . ($fila["n_chasis"] ?? '') . "</td>";
    echo "<td>" . ($fila["n_motor"] ?? '') . "</td>";
    echo "</tr>";
     
    
    
        
        }
    
    }
?>
    <script src="popup.js"></script>
</body>
</html> 