<?php
include 'conexionbd.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="inicio.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        
        <?php if (isset($_SESSION['perfil'])): ?>
            <h2>Perfil <?php echo $_SESSION['perfil']; ?></h2>
        <?php endif; ?>
        
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        
        <nav>
            <a href="inicio1.php" class="text-white">Inicio</a> | 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>  
                <a href="serviciospendientes/spendientes.php" class="text-white">Servicios pendientes</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>  
                <a href="solservicio/servicios.php" class="text-white">Servicios</a> | 
                <a href="misautos/misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="aautos/aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos/insumos.php" class="text-white">Insumos</a> |
                <a href= "allusr/usuarios.php" class="text-white">Usuarios</a> |
     
            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="login/registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="btn btn-link text-white p-0" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>

    <div class="container mt-4">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
           
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
            </div>
            
            <div class="carousel-inner rounded shadow"> 
                <div class="carousel-item active">
                    <img src="carruselinicio/imagen1.jpg" class="d-block w-100" alt="Auto deportivo en exhibición">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Vehículos Nuevos</h5>
                        <p>Descubre nuestra amplia selección de vehículos de última generación</p>
                    </div>
                </div>
                
        
                <div class="carousel-item">
                    <img src="carruselinicio/imagen2.jpg" class="d-block w-100" alt="Taller mecánico profesional">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Servicio Técnico</h5>
                        <p>Taller especializado con mecánicos certificados</p>
                    </div>
                </div>

               <div class="carousel-item">
                    <img src="carruselinicio/imagen3.jpg" class="d-block w-100" alt="Vehículo familiar">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Seminuevos Garantizados</h5>
                        <p>Los mejores vehículos seminuevos con garantía extendida</p>
                    </div>
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
