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
            <?php foreach ($_SESSION['servicios'] as $servicio): ?>
                <button class="btn-abrir-popup"
                data-vehiculo="<?php echo ($servicio['vehiculo']); ?>"
                data-fecha="<?php echo ($servicio['fecha'] ?? ''); ?>"
                data-tipo="<?php echo ($servicio['tipo'] ?? ''); ?>"
                data-desc="<?php echo ($servicio['desc'] ?? ''); ?>"
                data-estado="<?php echo ($servicio['estado'] ?? ''); ?>">
                <h5><?php echo ($servicio['vehiculo']); ?></h5>
                <p><?php echo ($servicio['fecha'] ?? ''); ?></p>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2>Detalles del Servicio</h2>
            <p id="popup-vehiculo"></p>
            <p id="popup-tipo"></p>
            <p id="popup-fecha"></p>
            <p id="popup-desc"></p>
            <p id="popup-estado"></p>
            <button class="btn btn-primary" id="btn-confirmar">Confirmar Servicio</button>
        </div>
    </div>


    <script src="popup.js"></script>
</body>
</html>