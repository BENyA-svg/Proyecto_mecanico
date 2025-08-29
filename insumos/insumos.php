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
   <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="insumos.css">
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
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="../aautos/aautos.php" class="text-white">Agregar vehículo</a> |
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
    <div class="insumo-btn-container">
        <a href="#" class="btn-añadir-insumo"><i class="fa-solid fa-circle-plus"></i></a>
    </div>

    <div class="border-container">
        <div class="card">
            <img src="imagenes\aceite.png" class="card-img-top" alt="Aceite">
            <div class="card-body">
                <h5 class="card-title">Aceite</h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary btn-editar"
                data-nombre="Aceite"
                data-tipo="Lubricante"
                data-cantidad="10"
                data-precio="500">Editar</a>
            </div>
        </div>

        <div class="card">
            <img src="imagenes\aceite.png" class="card-img-top" alt="Aceite">
            <div class="card-body">
                <h5 class="card-title">Aceite</h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary btn-editar"
                data-nombre="Aceite"
                data-tipo="Lubricante"
                data-cantidad="10"
                data-precio="500">Editar</a>
            </div>
        </div>
    </div> <!-- Cierra el div con class="border-container" --> 

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2>Informacion del insumo:</h2>
            <form action="#" class="formulario">
                <div class="info">
                    <label  for="nombre">Nombre: </label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="info">
                    <label  for="tipo">Tipo: </label>
                    <input type="text" id="tipo" name="tipo" required>
                </div>
  
                <div class="info">
                    <label  for="cantidad">Cantidad: </label>
                    <input type="number" id="cantidad" name="cantidad" required>
                </div>
 
                <div class="info">
                    <label for="precio">Precio: </label>
                    <input type="number" id="precio" name="precio" required>
                    <br>
                </div>
                <div class="info">
                    <label for="asociar">Asociar a servicios: </label>
                    <select id="asociar" name="asociar">
                        <option value="">Seleccionar servicio</option>
                        <option value="servicio1">servicio 1</option>
                        <option value="servicio2">servicio 2</option>
                    </select>   
                    <a href="#" id="agregar-servicio" class="agregar-servicio"><i class="fa-solid fa-plus"></i></a>
                </div>
                <button class="btn btn-primary" id="btn-confirmar">Agregar insumo</button>
            </form>
        </div>
    </div>
    <script src="popup.js"></script>
</body>
</html>