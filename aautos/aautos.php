<?php
include ('../conexionbd.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="aautos.css">

</head>
<body>
    

    <div class="header-section">
        <h2>JuancitoMotores</h2>
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> |
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>   
                <a href="servicios.php" class="text-white">Servicios</a>
                <a href="#" class="text-white">Mis autos</a> | 
            <?php endif; ?> 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehiculo</a> |
                <a href="../insumos/insumos.php" class="text-white">Insumos</a> |
                <a href= "allusr/usuarios.php" class="text-white">Usuarios</a> |
            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="../inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="text-white" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>
    <div class="container mt-5">
        <div class="form-container">
            <form action="" method="post">
                <label for="usuario">Usuario:</label>
                <br>
                <select  required name="usuario">
                    <option value="" disabled selected>Selecciona un usuario</option>
                    <option value="José">José</option>
                    <option value="Martín">Martín</option>
                    <option value="Marcos">Marcos</option>
                    <option value="Tito">Titocalderon</option>
                </select>
                <br>
       
                <label for="marca">Marca:</label>
                <br>
                <select required name="marca" id="">
                    <option value="" disabled selected>Selecciona una marca</option>
                    <option value="toyota">Toyota</option>
                    <option value="ford">Ford</option>
                    <option value="chevrolet">Chevrolet</option>
                </select>
                <br>
                <label for="modelo">Modelo:</label>
                <br>
                <input type="text" name="modelo" id="" required>
                <br>
                <label for="fecha">Fecha de compra:</label>
                <br>
                <input type="datetime-local" name="fecha" id="">
                <button type="submit">Enviar</button>
            </form>

        </div>
    </div>
    <br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
