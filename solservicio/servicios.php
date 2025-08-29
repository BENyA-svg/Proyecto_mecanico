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
   
    <link rel="stylesheet" href="servicios.css">
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
                <a href="servicios.php" class="text-white">Servicios</a> |
                <a href="../misautos/misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehículo</a> |
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
    
    <form action="#" method="post" >
        <div class="container mt-5">
            <div class="form-container">
                <label for="marca">Marca:</label>
                <select class="form-control" name="marca" id="marca">
                    <option value="toyota">Toyota</option>
                    <option value="ford">Ford</option>
                    <option value="chevrolet">Chevrolet</option>
                    <option value="bmw">Bmw</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="Byd">Byd Electrico</option>
                    <option value="maserati">Maserati</option>
                    <option value="Porsche">Porsche</option>
                </select>
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" name="modelo" id="modelo" required>
                <label for="fecha">Fecha preferida:</label>
                <input type="datetime-local" class="form-control" name="fecha" id="fecha">
                <label for="servicio">servicio:</label>
                <select class="form-control" name="servicio" id="servicio">
                    <option value="10000">10000km</option>
                    <option value="20000">20000km</option>
                    <option value="30000">30000km</option>
                    <option value="40000">40000km</option>
                    <option value="50000">50000km</option>
                    <option value="60000">60000km</option>
                    <option value="70000">70000km</option>
                    <option value="80000">80000km</option>
                </select>
                <br>
            
                <button type="submit" class="btn btn-primary">Solicitar</button>
            </div>
        </div>
    </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
